<?php

namespace App\Livewire\Receptionist\Doctors;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

final class Table extends PowerGridComponent
{
    use WithExport;

    public bool $deferLoading = true;

    public string $loadingComponent = 'components.loading-table';

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
        return User::where('role', 'doctor');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('names', fn ($dish) => '<a wire:navigate href="' . route('receptionist.doctors.show', ['doctor' => $dish]) . '" class="text-link-adp">' . $dish->names . '</a>')
            ->add('names_export', fn ($dish) => $dish->names)
            ->add('last_names')
            ->add('gender', fn ($dish) => getGenderName($dish))
            ->add('dni')
            ->add('phone')
            ->add('emergency_phone')
            ->add('email');
    }

    public function columns(): array
    {
        return [
            Column::action('Acciones'),

            Column::make('ID', 'id'),

            Column::make('Nombres', 'names')
                ->visibleInExport(visible: false),

            Column::make('Nombres', 'names_export')
                ->visibleInExport(visible: true)
                ->hidden(),

            Column::make('Apellidos', 'last_names')
                ->sortable()
                ->searchable(),

            Column::make('Genéro', 'gender')
                ->sortable()
                ->searchable(),

            Column::make('DNI', 'dni')
                ->sortable()
                ->searchable(),

            Column::make('Teléfono', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Teléfono de emergencia', 'emergency_phone')
                ->sortable()
                ->searchable(),

            Column::make('Correo', 'email')
                ->sortable()
                ->searchable()
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(User $row): array
    {
        return [
            Button::add('schedules')
                ->slot('<x-icon name="clock" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-green')
                ->dispatch('schedules', [$row->id]),
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
