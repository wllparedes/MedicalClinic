<section class="mt-4">
    @if ($haveDiagnosis)
        <div class="treatments border border-dashed border-amber-500 p-4 rounded-md">
            <p class="text-amber-500 font-bold text-xs mb-5 underline underline-offset-8">
                TRATAMIENTOS:
            </p>

            <livewire:doctor.treatment.create-modal :diagnosis="$appointment->diagnosis" lazy />

            <livewire:doctor.treatment.record :diagnosis="$appointment->diagnosis" />

            <livewire:doctor.treatment.add-medicines />

        </div>
    @endif
</section>
