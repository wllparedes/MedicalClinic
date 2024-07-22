<form wire:submit='register'>
    @csrf

    <div class="flex gap-3 form-control">
        <x-input icon="user" id="names" class=" mt-1 w-full" type="text" label="Nombres"
            wire:model="registerForm.names" placeholder="Ingrese los nombres" />

        <x-input icon="user" id="last_names" class="mt-1 w-full" type="text" label="Apellidos"
            placeholder="Ingrese los apellidos" wire:model="registerForm.last_names" />
    </div>

    <div class="mt-4 flex gap-3 form-control">

        <x-input icon="user-circle" id="username" class="block mt-1 w-full" placeholder="Ingrese el nombre de usuario"
            label="Nombre de usuario" wire:model="registerForm.username" />
    </div>

    <div class="mt-4 flex gap-3 form-control">
        <x-input icon="at-symbol" id="email" class="block mt-1 w-full" type="email"
            placeholder="Ingrese el correo" label="Correo" wire:model="registerForm.email" />
    </div>

    <div class="mt-4 flex gap-3 form-control">
        <x-maskable icon="hashtag" mask="##-##-##-##" id="dni" class="block mt-1 w-full" label="DNI"
            placeholder="Ingrese el dni" wire:model="registerForm.dni" />

        <x-maskable icon="phone" mask="(+51) ###-###-###" id="phone" class="block mt-1 w-full" type="text"
            placeholder="Ingrese el número telefonico" label="Telefono" wire:model='registerForm.phone' />
    </div>

    <div class="mt-4 flex gap-3 form-control">
        <livewire:radio-two label="Género" leftLabel="Hombre" rightLabel="Mujer" wire:model='registerForm.gender' />
    </div>

    <div class="mt-4 flex gap-3 form-control">
        <x-password id="password" class="block mt-1 w-full" type="password" label="Contraseña"
            wire:model='registerForm.password' placeholder="Ingrese su contraseña" />
    </div>

    <div class="mt-4">
        <x-password id="password_confirmation" class="block mt-1 w-full" type="password"
            placeholder="Confirme su contraseña" label="{{ __('Confirm Password') }}"
            wire:model='registerForm.password_confirmation' />
    </div>

    {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
<div class="mt-4">
<x-label for="terms">
    <div class="flex items-center">
        <x-checkbox name="terms" id="terms" required />

        <div class="ms-2">
            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                'terms_of_service' =>
                    '<a target="_blank" href="' .
                    route('terms.show') .
                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                    __('Terms of Service') .
                    '</a>',
                'privacy_policy' =>
                    '<a target="_blank" href="' .
                    route('policy.show') .
                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                    __('Privacy Policy') .
                    '</a>',
            ]) !!}
        </div>
    </div>
</x-label>
</div>
@endif --}}

    <div class="flex items-center justify-end mt-4">
        <a wire:navigate
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-button type="submit" cyan class="ms-4">
            Solicitar registro
        </x-button>
    </div>
</form>
