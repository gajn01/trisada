<?php 
namespace App\Traits;

trait Sortable
{
    public $sortby;
    public $sortdirection;

        // Declare public sortby and public sortdirection in component.
        public function sort($field)
        {
            if($this->sortby <> $field) $this->sortdirection = '';
            $this->sortby = $field;
            if($this->sortdirection == '')
            {
                $this->sortdirection = 'asc';
            }
            elseif($this->sortdirection == 'asc')
            {
                $this->sortdirection = 'desc';
            }    
            else
            {
                $this->sortdirection = '';
            }
        }

}