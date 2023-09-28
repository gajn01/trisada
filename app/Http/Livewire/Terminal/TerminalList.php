<?php

namespace App\Http\Livewire\Terminal;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class TerminalList extends Component
{  
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $driver_id;
    public $displaypage = 10;
    public $search = '';
    public $isedit = false;
    public $department_list;
    public $is_logistic = false;
    public function render()
    {
        return view('livewire.terminal.terminal-list');
    }
}
