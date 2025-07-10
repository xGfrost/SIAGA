<?php

namespace App\Livewire;

use App\Models\Measurement as ModelsMeasurement;
use Livewire\Component;

class Measurement extends Component
{
    public $measurements;

    public function mount()
    {
        $this->measurements = ModelsMeasurement::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.measurement');
    }
}
