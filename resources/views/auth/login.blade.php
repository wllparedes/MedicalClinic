<x-guest-layout>
    <div class="absolute top-0 left-0 bottom-0 leading-5 h-full w-full overflow-hidden" id="container-background">
    </div>
    <div class="relative min-h-screen sm:flex sm:flex-row justify-center bg-transparent rounded-3xl flex">
        {{-- <div class="flex-col flex  self-center lg:px-14 sm:max-w-4xl xl:max-w-md  z-10">
            <div class="self-start hidden lg:flex flex-col  text-gray-300">
                <h1 class="my-3 font-semibold text-4xl">Bienvenido a Clinica Médica</h1>
                <p class="pr-3 text-sm opacity-75">
                    Sistema de gestión de pacientes y citas médicas.
                </p>
            </div>
        </div> --}}
        <div class="flex justify-center self-center z-10">
            <div id="container-login" class="p-4 mx-auto w-96 m-5 bg-slate-300">
                <div class="sub-container bg-white mx-auto w-100 p-8">
                    <div class="mb-7">
                        <h3 class="font-semibold text-2xl text-gray-800 text-center">Clinica ADP</h3>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <x-input icon="user" label="{{ __('Username') }}" id="username" name="username"
                            placeholder="Ingrese su nombre de usuario" :value="old('username')" />

                        <div class="mt-4">
                            <x-password label="{{ __('Password') }}" id="password" name="password"
                                placeholder="Ingrese su contraseña" autocomplete="current-password" />
                        </div>

                        <div class="mt-4">
                            <div class="flex justify-between items-end mb-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Ingresar como
                                </label>
                            </div>
                            <div class="flex gap-3 items-center">
                                <x-radio id="role" name="role" left-label="Personal" wire:model="model1"
                                    value="staff" :checked="old('role') === 'staff'" checked />
                                <x-radio id="role" name="role" label="Paciente" wire:model="model1"
                                    value="patient" :checked="old('role') === 'patient'" />
                            </div>
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="mt-4">
                            <x-button type="submit" class="w-full" teal label="{{ __('Log in') }}" />
                        </div>
                    </form>

                    <div class="mt-7 text-center text-gray-300 text-xs">
                        <span class="text-slate-500">
                            Copyright &copy; {{ getCurrentYear() }}
                            <a href="{{ route('login') }}" rel="" target="_blank" title="Codepen aji"
                                class="text-teal-500 hover:text-teal-600">
                                Clinica Médica
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
