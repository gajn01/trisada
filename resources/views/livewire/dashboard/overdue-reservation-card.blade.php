<div class="col">
    <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4" wire:poll.60s>
            <h4 class="stats-type mb-1 cta-color">Overdue Reservation</h4>
            <div class="stats-figure">{{ $count }}</div>
        </div><!--//app-card-body-->
        <a class="app-card-link-mask" href="{{ route('reservation-list') }}"></a>
    </div><!--//app-card-->
</div><!--//col-->