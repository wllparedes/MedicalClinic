<?php

namespace App\Livewire\Doctor\Treatment;

use App\Models\Diagnosis;
use App\Models\Treatment;
use Livewire\Attributes\On;
use Livewire\Component;

class Record extends Component
{

    public Diagnosis $diagnosis;
    public $treatments = [];

    public function mount(Diagnosis $diagnosis)
    {
        $this->diagnosis = $diagnosis;
        $this->loadTreatments();
    }

    #[On('treatment:refresh')]
    public function loadTreatments()
    {
        $this->diagnosis->load([
            'treatments',
            'treatments.products'
        ]);

        $this->treatments = $this->diagnosis->treatments;
    }

    public function addMedicines(Treatment $treatment)
    {
        $this->dispatch('medicines:add', [
            'treatment' => $treatment
        ]);
    }

    public function render()
    {
        return view('livewire.doctor.treatment.record');
    }
}
