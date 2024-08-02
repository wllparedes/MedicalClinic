<?php

namespace App\Livewire\Admin\Specialties;

use App\Models\Specialty;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
use Str;
use WireUi\Traits\WireUiActions;

final class Table extends PowerGridComponent
{
    use WithExport;
    use WireUiActions;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading-table';

    #[On('table-specialty:refresh')]
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
        return Specialty::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('description', fn ($dish) => getDescription($dish->description))
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::action('Acciones'),

            Column::make('ID', 'id'),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Descripción', 'description')
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

    #[On('deleteSpecialty')]
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

    public function confirmDelete(Specialty $specialty)
    {
        if ($specialty) {
            $specialty->doctors()->detach();
            $specialty->delete();
            $this->dialog()->success(config('parameters.messages.success_delete'));
        } else {
            $this->dialog()->success(config('parameters.messages.error_delete'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(config('parameters.messages.operation_cancelled'));
    }

    public function actions(Specialty $row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-yellow')
                ->dispatch('editSpecialty', [$row->id]),
            Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-red')
                ->dispatch('deleteSpecialty', [$row->id])
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
