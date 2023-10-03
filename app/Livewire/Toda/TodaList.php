<?php

namespace App\Livewire\Toda;

use Livewire\Component;
use App\Models\Toda;

class TodaList extends Component
{
    public function render()
    {
        $todaList = $this->getTodaList();
        return view('livewire.toda.toda-list', ['todaList' => $todaList]);
    }
    public function getTodaList()
    {
        return Toda::get();
    }
}
