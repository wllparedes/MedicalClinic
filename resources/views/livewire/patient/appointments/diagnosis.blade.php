<section class="container-diagnosis-treatments w-full flex gap-4 flex-col">

    <div class="diagnosis border border-dashed border-teal-600 p-4 rounded-md">

        @if (!$appointment->diagnosis)
            <section>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Diagnostico:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->diagnosis }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Prescripción:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->prescription }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Notas:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->note ?? '-' }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Necesita tratamiento:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->need_treatment ? 'SI' : 'NO' }}
                        </span>
                    </div>
                </div>
            </section>
        @else
            
        @endif

    </div>

</section>
