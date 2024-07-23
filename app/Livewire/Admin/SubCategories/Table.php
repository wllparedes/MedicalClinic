<?php

namespace App\Livewire\Admin\SubCategories;

use App\Models\SubCategory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
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

    public array $nameSub;

    public bool $showErrorBag = true;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading-table';

    #[On('table-subCategory:refresh')]
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
        return SubCategory::with('category:id,name')->withCount('products');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('category_name', fn ($dish) => $dish->category->name)
            ->add('nameSub', fn ($dish) => $dish->name)
            ->add('slug')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),

            Column::make('ID', 'id'),

            Column::make('Categoría perteneciente', 'category_name'),

            Column::make('Nombre', 'nameSub')
                ->sortable()
                ->editOnClick(hasPermission: true, dataField: 'nameSub')
                ->searchable(),

            Column::make('Slug', 'slug')
                ->sortable()
                ->searchable(),

            Column::make('Creado el', 'created_at')
                ->sortable()
                ->searchable()
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[On('deleteSubcategory')]
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

    public function confirmDelete(SubCategory $subcategory)
    {
        if ($subcategory) {
            $subcategory->products()->detach();
            $subcategory->delete();
            $this->dialog()->success(config('parameters.messages.success_delete'));
            $this->dispatch('table-category:refresh');
        } else {
            $this->dialog()->success(config('parameters.messages.error_delete'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(config('parameters.messages.operation_cancelled'));
    }

    public function actions(SubCategory $row): array
    {
        return [
            Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-red')
                ->dispatch('deleteSubcategory', [$row->id])
        ];
    }

    public function actionRules($row): array
    {
        return [
            Rule::button('edit')
                ->when(fn ($row) => $row->products_count >= 1)
                ->hide(),
        ];
    }

    protected function rules()
    {
        return [
            'nameSub.*' => [
                'required'
            ],
        ];
    }

    protected function messages()
    {
        return [
            'nameSub.*.required' => config('parameters.messages.name_required'),
        ];
    }

    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {

        if ($field == 'nameSub') {
            $this->validate();

            $subcategory = SubCategory::find($id);

            if ($subcategory) {

                $subcategory->update([
                    'name' => $value,
                    'slug' => Str::slug($value)
                ]);

                $this->dispatch('table-category:refresh');
            }
        }
    }
}
