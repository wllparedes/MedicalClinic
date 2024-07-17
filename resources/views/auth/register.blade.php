<x-guest-layout>
    <div class="absolute top-0 left-0 bottom-0 leading-5 h-full w-full overflow-hidden" id="container-background">
    </div>
    <div class="relative min-h-screen sm:flex sm:flex-row justify-center bg-transparent rounded-3xl flex">
        <div class="flex justify-center self-center z-10">
            <div id="container-login" class="container-register p-4 mx-auto m-5 bg-slate-300">
                <div class="sub-container bg-white mx-auto w-100 p-8">
                    <div class="mb-7">
                        <h3 class="font-semibold text-2xl text-gray-800 text-center">Solicitar registro | Paciente</h3>
                    </div>

                    <livewire:common.register />

                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
