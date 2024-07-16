<?php

namespace App\Livewire\Receptionist\Doctors;

use App\Livewire\Forms\Common\Doctor\ScheduleForm;
use App\Models\Day;
use App\Models\Schedule;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ScheduleModal extends Component
{
    public $openSchedule = false;
    public ScheduleForm $createForm;
    public User $doctor;
    public $daysWork = [];

    public function mount()
    {
        $this->daysWork = Day::all();
    }

    public function save()
    {
        if ($this->scheduleExits()) {
            $this->createForm->validate();
            $this->addError('scheduleExists', config('parameters.messages.schedule_exists'));
        } else {
            $this->createForm->save();
            $this->dispatch('loadScheduleList', $this->doctor);
        }
    }

    #[On('schedules')]
    public function openSchedule(User $doctor)
    {
        $this->doctor = $doctor;
        $this->createForm->doctor = $doctor;
        $this->dispatch('loadScheduleList', $this->doctor);
        $this->openSchedule = true;
    }

    //

    private function scheduleExits()
    {
        $count = Schedule::where('doctor_id', $this->doctor->id)
            ->where('day_id', $this->createForm->day)
            ->where('start', $this->createForm->start)
            ->where('end', $this->createForm->end)
            ->count();

        return $count > 0;
    }

    public function render()
    {
        return view('livewire.receptionist.doctors.schedule-modal');
    }
}
