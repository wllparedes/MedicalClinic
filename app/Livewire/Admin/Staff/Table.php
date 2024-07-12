<?php

namespace App\Livewire\Admin\Staff;

use App\Models\User;
use App\Services\FileService;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
use WireUi\Traits\WireUiActions;

final class Table extends PowerGridComponent
{
    use WithExport;
    use WireUiActions;

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
        return User::with([
            'file' => fn ($q) => $q->where('category', 'avatars')
        ]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        $user = User::find($id);
        $value = intval($value);

        $user->update([$field => $value]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('avatar', fn ($dish) => '<img class="w-10 h-10 shrink-0 grow-0 rounded-full" src="' . verifyMultipleAvatar($dish->file, $dish->names) . '">')
            ->add('names', fn ($dish) => '<a wire:navigate href="' . route('admin.staff.show', $dish) . '" class="text-link-adp">' . $dish->names . '</a>')
            ->add('names_export', fn ($dish) => $dish->names)
            ->add('last_names')
            ->add('username')
            ->add('gender', fn ($dish) => getGenderName($dish->gender))
            ->add('dni')
            ->add('phone')
            ->add('emergency_phone', fn ($dish) => $dish->emergency_phone ?? '-')
            ->add('role', fn ($dish) => getRoleName($dish->role))
            ->add('active')
            ->add('email');
    }

    public function columns(): array
    {
        return [

            Column::action('Acciones'),
            Column::make('ID', 'id'),

            Column::make('Avatar', 'avatar')
                ->visibleInExport(visible: false),

            Column::make('Nombres', 'names')
                ->visibleInExport(visible: false),

            Column::make('Nombres', 'names_export')
                ->hidden()
                ->visibleInExport(visible: true),

            Column::make('Apellidos', 'last_names')
                ->sortable()
                ->searchable(),

            Column::make('Nombre de usuario', 'username')
                ->sortable()
                ->searchable(),

            Column::make('Género', 'gender')
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

            Column::make('Rol', 'role')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'active')
                ->visibleInExport(visible: false)
                ->toggleable(),

            Column::make('Estado', 'active-export')
                ->visibleInExport(visible: true)
                ->hidden(true),

            Column::make('Correo', 'email')
                ->sortable()
                ->searchable()
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
            'method'      => 'deleteUser',
            'params'      => $rowId,
            'reject' => [
                'label'  => __('Cancel'),
                'method' => 'cancel',
            ],
        ]);
    }

    public function deleteUser(User $user)
    {
        if ($user) {

            $user->load([
                'file' => fn ($q) => $q->where('category', 'avatars')
            ]);

            if ($user->file) {
                $storage = env('FILESYSTEM_DISK');
                $fileService = new FileService();
                $fileService->destroy($user->file, $storage);
            }

            $user->delete();

            $this->dialog()->success(config('parameters.messages.success_delete'));
        } else {

            $this->dialog()->error(config('parameters.messages.error_delete'));
        }
    }

    public function cancel(): void
    {
        $this->notification()->info(config('parameters.messages.operation_cancelled'));
    }

    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-yellow')
                ->dispatch('editUser', [$row->id]),
            Button::add('delete')
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->id()
                ->class('pg-btn pg-btn-red')
                ->dispatch('delete', [$row->id])
        ];
    }

    public function actionRules($row): array
    {
        return [
            Rule::button('delete')
                ->when(fn ($row) => $row->id === Auth::user()->id)
                ->hide(),
        ];
    }
}
