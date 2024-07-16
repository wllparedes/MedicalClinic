<?php

namespace App\Livewire\Forms\Common\Doctor;

use App\Models\Schedule;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ScheduleForm extends Form
{
    #[Validate('required')]
    public $day;
    #[Validate('required|date_format:H:i|before:end')]
    public $start;
    #[Validate('required|date_format:H:i|after:start')]
    public $end;
    public User $doctor;

    public function save()
    {
        $this->validate();

        $schedule = $this->doctor->schedules()->create([
            'day_id' => $this->day,
            'start' => $this->start,
            'end' => $this->end,
        ]);

        if ($schedule) {
            $this->reset('day', 'start', 'end');
        }
    }
}
