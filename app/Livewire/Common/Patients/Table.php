<?php

namespace App\Livewire\Common\Patients;

use App\Models\Patient;
use App\Services\FileService;
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
        return Patient::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        $user = Patient::find($id);
        $value = intval($value);

        $user->update([$field => $value]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('names', fn ($dish) => '<a wire:navigate href="' . getRoutePatientShow($dish) . '" class="text-link-adp">' . $dish->names . '</a>')
            ->add('last_names')
            ->add('username')
            ->add('gender', fn ($dish) => getGenderName($dish->gender))
            ->add('birthday_formatted', fn (Patient $model) => Carbon::parse($model->birthday)->format('d/m/Y'))
            ->add('district', fn ($dish) => $dish->district ?? '-')
            ->add('province', fn ($dish) => $dish->province ?? '-')
            ->add('address', fn ($dish) => $dish->address ?? '-')
            ->add('dni')
            ->add('phone')
            ->add('emergency_phone', fn ($dish) => $dish->emergency_phone ?? '-')
            ->add('email')
            ->add('nationality', fn ($dish) => $dish->nationality ?? '-')
            ->add('active')
            ->add('status', fn ($dish) => Blade::render(getBadgeStatusBlade($dish->status)));
    }

    public function columns(): array
    {
        return [
            Column::action('Acciones'),
            Column::make('ID', 'id'),
            Column::make('Nombres', 'names')
                ->sortable()
                ->searchable(),

            Column::make('Apellidos', 'last_names')
                ->sortable()
                ->searchable(),

            Column::make('Nombre de usuario', 'username')
                ->sortable()
                ->searchable(),

            Column::make('Genéro', 'gender')
                ->sortable()
                ->searchable(),

            Column::make('Nacimiento', 'birthday_formatted', 'birthday')
                ->sortable(),

            Column::make('Distrito', 'district')
                ->sortable()
                ->searchable(),

            Column::make('Provincia', 'province')
                ->sortable()
                ->searchable(),

            Column::make('Dirección', 'address')
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
                ->searchable(),


            Column::make('Activo', 'active')
                ->visibleInExport(visible: false)
                ->toggleable(),

            Column::make('Activo', 'active-export')
                ->visibleInExport(visible: true)
                ->hidden(true),

            Column::make('Estado', 'status')
                ->sortable()
                ->searchable()
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::datepicker('birthday'),
        ];
    }

    #[On('delete')]
    public function delete($rowId): void
    {
        $this->dialog()->confirm([
            'title'       => config('parameters.messages.are_you_sure_?'),
            'description' => config('parameters.messages.delete_record_?'),
            'acceptLabel' => config('parameters.messages.yes_deleted'),
            'method'      => 'deleteUser',
            'params'      => $rowId,
            'reject' => [
                'label'  => __('Cancel'),
                'method' => 'cancel',
            ],
        ]);
    }

    public function deleteUser(Patient $patient)
    {
        if ($patient) {

            $patient->load([
                'file' => fn ($q) => $q->where('category', 'avatars')
            ]);

            if ($patient->file) {
                $storage = env('FILESYSTEM_DISK');
                $fileService = new FileService();
                $fileService->destroy($patient->file, $storage);
            }

            $patient->delete();

            $this->dialog()->success(config('parameters.messages.success_delete'));
        } else {

            $this->dialog()->error(config('parameters.messages.error_delete'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(config('parameters.messages.operation_cancelled'));
    }

    public function actions(Patient $row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-yellow')
                ->dispatch('editPatient', [$row->id]),
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
