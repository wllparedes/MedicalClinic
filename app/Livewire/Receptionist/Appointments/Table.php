<?php

namespace App\Livewire\Receptionist\Appointments;

use App\Models\Appointment;
use Blade;
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
        return Appointment::with(['patient', 'doctor']);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('patient', fn ($dish) => $dish->patient->full_name)
            ->add('doctor', fn ($dish) => $dish->doctor ? $dish->doctor->full_name : Blade::render('<x-badge outline amber label="Sin doctor asignado" />'))
            ->add('motive', fn ($dish) => $dish->motive)
            ->add('date_formatted', fn (Appointment $model) => Carbon::parse($model->date)->format('d/m/Y'))
            ->add('start', fn ($dish) => $dish->start ?? '-')
            ->add('end', fn ($dish) => $dish->end ?? '-')
            ->add('message', fn ($dish) => getDescription($dish->message) ?? '-')
            ->add('type', fn ($dish) => getTypeAppointments($dish->type))
            ->add('link', fn ($dish) => $dish->link ? "<a target='_BLANK' href='" . $dish->link . "' class='text-link-adp'>" . getDescription($dish->link, 20) . "</a>" : '-')
            ->add('status', fn ($dish) => Blade::render(getBadgeStatusBlade($dish->status)))
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::action('Acciones'),
            Column::make('ID', 'id'),
            Column::make('Paciente', 'patient'),
            Column::make('Doctor', 'doctor'),
            Column::make('Motivo', 'motive')
                ->sortable()
                ->searchable(),

            Column::make('Fecha', 'date_formatted', 'date')
                ->sortable(),

            Column::make('Hora de entrada', 'start')
                ->sortable()
                ->searchable(),

            Column::make('Hora de finalización', 'end')
                ->sortable()
                ->searchable(),

            Column::make('Mensaje', 'message')
                ->sortable()
                ->searchable(),

            Column::make('Tipo', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Enlace', 'link')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Solicitado el', 'created_at')
                ->sortable()
                ->searchable(),

        ];
    }

    public function filters(): array
    {
        return [
            // Filter::datepicker('date'),
        ];
    }

    #[On('viewAppointment')]
    public function viewAppointment(Appointment $appointment)
    {
        $this->redirect(route('receptionist.appointments.show', $appointment), navigate: true);
    }

    public function actions(Appointment $row): array
    {
        return [
            Button::add('delete')
                ->slot('<x-icon name="eye" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-blue')
                ->dispatch('viewAppointment', [$row->id])
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
