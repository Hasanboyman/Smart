<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChangeBackgroundColor extends Component
{
    public $selectedColor = null;
    public $gradientEnabled = false;

    public function changeBackgroundColor($color)
    {
        if (!$this->gradientEnabled) {
            $this->selectedColor = $color;
            $this->emit('updateBackgroundColor', ['color' => $color, 'gradient' => false]);
        }
    }

    public function toggleGradient()
    {
        $this->gradientEnabled = !$this->gradientEnabled;
        $this->emit('updateBackgroundColor', ['gradient' => $this->gradientEnabled]);
    }

    public function resetBackgroundColor()
    {
        $this->selectedColor = null;
        $this->gradientEnabled = false;
        $this->emit('updateBackgroundColor', ['color' => 'white', 'gradient' => false]);
    }

    public function render()
    {
        return view('livewire.change-background-color');
    }
}
