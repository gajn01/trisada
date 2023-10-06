<div>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0 cta-color">Trisada System</h1>
        </div>
    </div><!--//row-->

 
    <div class="row g-4 mb-4">
        <div class="col">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4" wire:poll.60s>
                    <h4 class="stats-type mb-1 primary-color">Active User</h4>
                    <div class="stats-figure">3</div>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" {{-- href="{{ route('reservation-list') }}" --}}></a>
            </div><!--//app-card-->
        </div><!--//col-->
        <div class="col">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4" wire:poll.60s>
                    <h4 class="stats-type mb-1 primary-color">Active Driver</h4>
                    <div class="stats-figure">20</div>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" {{-- href="{{ route('reservation-list') }}" --}}></a>
            </div><!--//app-card-->
        </div><!--//col-->
        <div class="col">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4" wire:poll.60s>
                    <h4 class="stats-type mb-1 primary-color">Total Toda</h4>
                    <div class="stats-figure">5</div>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" {{-- href="{{ route('reservation-list') }}" --}}></a>
            </div><!--//app-card-->
        </div><!--//col-->
    </div>
