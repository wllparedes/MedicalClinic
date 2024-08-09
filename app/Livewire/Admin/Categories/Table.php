<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\On;
use phpDocumentor\Reflection\PseudoTypes\True_;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Str;
use WireUi\Traits\WireUiActions;

final class Table extends PowerGridComponent
{
    use WithExport;
    use WireUiActions;

    public array $nameCat;

    public bool $showErrorBag = true;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading-table';

    #[On('table-category:refresh')]
    public function refreshTable(): void
    {
        $this->resetPage();
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Category::with('subCategories')->withCount('subCategories');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nameCat', fn ($dish) => $dish->name)
            ->add('subCategories', fn ($dish) => Blade::render('<x-list-subcategories :subcategories="$subcategories" />', ['subcategories' => $dish->subCategories]))
            ->add('subCategories_export')
            ->add('slug')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::action('Acciones')
                ->visibleInExport(visible: false),

            Column::make('ID', 'id'),
            Column::make('Nombre', 'name')
                ->editOnClick(hasPermission: true, dataField: 'nameCat')
                ->sortable()
                ->searchable(),

            Column::make('Sub categorias', 'subCategories')
                ->visibleInExport(visible: false),

            Column::make('Sub categorias', 'subCategories_export')
                ->visibleInExport(visible: true)
                ->hidden(),

            Column::make('Slug', 'slug')
                ->sortable()
                ->searchable(),

            Column::make('Creado el', 'created_at')
                ->sortable()
                ->searchable(),

        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[On('deleteCategory')]
    public function delete($rowId): void
    {
        $this->dialog()->confirm([
            'title'       => config('parameters.messages.are_you_sure_?'),
            'description' => config('parameters.messages.delete_record_?'),
            'acceptLabel' => config('parameters.messages.yes_deleted'),
            'method'      => 'confirmDelete',
            'params'      => $rowId,
            'reject' => [
                'label'  => __('Cancel'),
                'method' => 'cancel',
            ],
        ]);
    }

    public function confirmDelete(Category $category)
    {
        if ($category) {
            $category->delete();
            $this->dialog()->success(config('parameters.messages.success_delete'));
        } else {
            $this->dialog()->success(config('parameters.messages.error_delete'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(config('parameters.messages.operation_cancelled'));
    }

    public function actions(Category $row): array
    {
        return [
            Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-red')
                ->dispatch('deleteCategory', [$row->id])
        ];
    }

    public function actionRules($row): array
    {
        return [
            Rule::button('delete')
                ->when(fn ($row) => $row->sub_categories_count >= 1)
                ->hide(),
        ];
    }

    protected function rules()
    {
        return [
            'nameCat.*' => [
                'required'
            ],
        ];
    }

    protected function messages()
    {
        return [
            'nameCat.*.required' => config('parameters.messages.name_required'),
        ];
    }

    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {

        if ($field == 'nameCat') {
            $this->validate();

            $category = Category::find($id);

            if ($category) {
                $category->update([
                    'name' => $value,
                    'slug' => Str::slug($value)
                ]);

                $this->dispatch('form-subCategory:refresh');
            }
        }
    }
}
