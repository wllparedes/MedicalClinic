<?php

namespace App\Livewire\Receptionist\Doctors;

use App\Models\Schedule;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ScheduleList extends Component
{

    public User $doctor;
    public $daysSchedules = [];

    #[On('loadScheduleList')]
    public function mountSchedule(User $doctor)
    {
        $this->doctor = $doctor;
        $this->loadSchedules();
    }

    public function deleteSchedule(Schedule $schedule)
    {
        $schedule->delete();
        $this->loadSchedules();
    }

    private function loadSchedules()
    {
        $this->doctor->load([
            'schedules', 'schedules.day:id,name'
        ]);

        $this->daysSchedules = collect($this->doctor->schedules->sortBy('day.id')->groupBy('day.name'));
    }

    public function render()
    {
        return view('livewire.receptionist.doctors.schedule-list');
    }
}
