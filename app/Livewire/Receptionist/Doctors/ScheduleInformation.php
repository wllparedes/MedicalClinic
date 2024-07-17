<?php

namespace App\Livewire\Receptionist\Doctors;

use App\Models\User;
use Livewire\Component;

class ScheduleInformation extends Component
{
    public User $doctor;
    public $daysSchedules = [];

    public function mount(User $doctor)
    {
        $this->doctor = $doctor;
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $this->doctor->load([
            'schedules', 'schedules.day:id,name'
        ]);

        $this->daysSchedules = collect($this->doctor->schedules->sortBy('day.id')->groupBy('day.name'));
    }

    public function render()
    {
        return view('livewire.receptionist.doctors.schedule-information');
    }
}
