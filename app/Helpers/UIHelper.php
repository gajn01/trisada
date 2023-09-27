<?php

namespace App\Helpers;

class UIHelper
{
    // set session message for livewire flash message and emit event.
    public static function flashMessage($componentInstance,$title,$message,$class)
    {
        $componentInstance->class = $class;
        session()->flash('title',$title);
        session()->flash('timestamp',date('g:i:s A',strtotime(now())));
        session()->flash('message', $message);
        $componentInstance->emit('show-toast');
    }


    // Used to display user friendly time elapse time stamp
    public static function ticketTimeStamp($toDate, $fromDate = null)
    {
        // Create two Carbon objects representing the two dates
        $date1 = \Carbon\Carbon::parse($toDate);
        $date2 = \Carbon\Carbon::parse(is_null($fromDate) ? now() : $fromDate);

        // Calculate the difference between the two dates in minutes
        $minutes_diff = $date1->diffInMinutes($date2);
        $hours_diff = $date1->diffInHours($date2);
        $days_diff = $date1->diffInDays($date2);

        // Return appropriate output
        if($minutes_diff == 0) return "Just now";
        if($minutes_diff < 60) return $minutes_diff == 1? "$minutes_diff minute ago" : "$minutes_diff minutes ago";
        if($hours_diff < 24) return $hours_diff == 1 ? "$hours_diff hour ago" : "$hours_diff hours ago";
        if($days_diff <= 7) return $days_diff == 1 ? "$days_diff day ago" : "$days_diff days ago";
        return $date1;
    }
}