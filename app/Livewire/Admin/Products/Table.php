<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Services\FileService;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use WireUi\Traits\WireUiActions;

final class Table extends PowerGridComponent
{
    use WithExport;
    use WireUiActions;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading-table';

    #[On('table:refresh')]
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
        return Product::with([
            'file' => fn ($q) => $q->where('category', 'products'),
            'category:id,name',
            'subCategories:id,name',
        ]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        $product = Product::find($id);
        $value = intval($value);
        $product->update([$field => $value]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('image', fn ($dish) => '<img class="w-16 h-16 shrink-0 grow-0 rounded-full border border-slate-200 shadow-lg" src="' . verifyImage($dish->file) . '">')
            ->add('name')
            ->add('slug')
            ->add('category', fn ($dish) => $dish->category->name)
            ->add('subCategories', fn ($dish) => Blade::render('<x-list-subcategories :subcategories="$subcategories" />', ['subcategories' => $dish->subCategories]))
            ->add('description', function ($dish) {
                $description = $dish->description;
                if (mb_strlen($description) > 17) {
                    return mb_substr($description, 0, 17) . '...';
                } else {
                    return $description;
                }
            })
            ->add('active');
    }

    public function columns(): array
    {
        return [

            Column::action('Acciones'),

            Column::make('ID', 'id'),

            Column::make('Imagen', 'image')
                ->visibleInExport(visible: false),

            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Slug', 'slug')
                ->sortable()
                ->searchable(),

            Column::make('Categoria', 'category'),

            Column::make('Subcategorias', 'subCategories'),

            Column::make('Descripción', 'description')
                ->sortable()
                ->searchable(),

            Column::make('Activo', 'active')
                ->visibleInExport(visible: false)
                ->toggleable()
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[On('delete')]
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

    public function deleteImage($file)
    {
        if ($file) {
            $fileService = new FileService();
            $storage = env('FILESYSTEM_DISK');
            $fileService->destroy($file, $storage);
        }
    }

    public function confirmDelete(Product $product)
    {
        if ($product) {
            $product->subCategories()->detach();
            $product->load([
                'file' => fn ($q) => $q->where('category', 'products')
            ]);
            $this->deleteImage($product->file);
            $product->delete();
            $this->dialog()->success(config('parameters.messages.success_delete'));
        } else {
            $this->dialog()->success(config('parameters.messages.error_delete'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(config('parameters.messages.operation_cancelled'));
    }

    public function actions(Product $row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-yellow')
                ->dispatch('editProduct', [$row->id]),
            Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-red')
                ->dispatch('delete', [$row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
