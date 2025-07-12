<?php

namespace App\Livewire;

use App\Models\Measurement as ModelsMeasurement;
use Livewire\Component;

class Measurement extends Component
{
    public $measurements = [];
    public $insertCount = 0;
    public $lastId;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $currentCount = ModelsMeasurement::count();

        if ($currentCount !== $this->insertCount) {
            $this->measurements = ModelsMeasurement::orderBy('created_at', 'desc')
            ->take(7)
            ->get()
            ->reverse()
            ->map(function ($m) {
                return [
                    'water_level_cm' => $m->water_level_cm,
                    'rainfall_mm' => $m->rainfall_mm,
                    'created_at' => $m->created_at->toISOString(),
                ];
            })->values()->toArray();

            $this->insertCount = $currentCount;

            $this->dispatch('dataUpdated', $this->measurements);
        }
    }

    public function refreshData()
    {
        ModelsMeasurement::create([
            'water_level_cm' => round(mt_rand(100, 300) / 10, 1),
            'rainfall_mm'    => round(mt_rand(0, 100) / 10, 1),
        ]);

        $this->loadData();
    }

    public function getStatsProperty()
    {
        if (empty($this->measurements)) {
            return [
                'avgWaterLevel' => 0,
                'maxWaterLevel' => 0,
                'totalRainfall' => 0,
                'maxRainfall' => 0
            ];
        }

        $waterLevels = array_column($this->measurements, 'water_level_cm');
        $rainfalls = array_column($this->measurements, 'rainfall_mm');

        return [
            'avgWaterLevel' => round(array_sum($waterLevels) / count($waterLevels), 1),
            'maxWaterLevel' => round(max($waterLevels), 1),
            'totalRainfall' => round(array_sum($rainfalls), 1),
            'maxRainfall' => round(max($rainfalls), 1)
        ];
    }

    public function render()
    {
        return view('livewire.measurement', [
            'measurements' => $this->measurements,
        ]);
    }
}
