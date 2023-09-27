<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reservation-list')}}">Reservation List</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reservation-details',[$bookingID])}}">Reservation Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Trip Ticket</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Create Trip Ticket</h1>
        </div>
    </div>
    <div class="app-card text-start shadow-sm p-4">
        <div class="app-card-body">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="mb-2">
                        <span class="fw-semibold">Booking Number: </span> <span class=""> {{ str_pad($reservationDetails->id, 10, '0', STR_PAD_LEFT) }}</span> 
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="mb-3">Vehicle & Driver Details</h5>
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Vehicle Code: </span> <span class="">{{ $reservationDetails->vehicle->code }}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Fuel Cap: </span> <span class="">{{ $reservationDetails->vehicle->fuel_capacity }}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Vehicle Model: </span> <span class="">{{ $reservationDetails->vehicle->model }}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Fuel Type: </span> <span class="">{{ $reservationDetails->vehicle->fuel_type }}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Vehicle Type: </span> <span class="">{{ $reservationDetails->vehicle->vehicle_type->name }}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Chasis No.: </span> <span class="">{{ $reservationDetails->vehicle->chassis_number }}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Driver`s Name: </span> <span class="">{{ $reservationDetails->own_driver_name->name ?? null}}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    {{-- <span class="fw-semibold">Driver`s Department: </span> <span class="">{{ $reservationDetails->own_driver_name->department->name }}</span>  --}}
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="mb-3">Routes</h5>
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Origin: </span> <span class="">{{ $reservationDetails->pickup_location }}</span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Destination Route: </span> <span class="">
                        @forelse ($destinationList as $destination)
                            <span class="fw-bold">{!! $destination !!} </span>
                            @if (!$loop->last)
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
                            @endif

                        @empty
                            {{ $reservationDetails->destination}}
                        @endforelse
                </span> 
                </div>
                <div class="col-sm-12 col-md-6">
                    <span class="fw-semibold">Distance: </span> <span class="">{{ $reservationDetails->trip_distance }} km</span> 
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-6">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="transaction_type" class="form-label small">Transaction Type <span class="text-danger">*</span></label>
                            <select id="transaction_type" name="transaction_type" wire:model="transaction_type" class="form-select form-select-sm" required>
                                <option value selected hidden>--Select Transaction--</option>
                               {{--  <option value=0>Pull-out</option>
                                <option value=1>Regular Deliveries</option> --}}
                                <option value=2>H.O. Company Vehicles</option>
                                <option value=3>Others</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-3">Tariff</h5>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Released(₱)</th>
                                    <th>Non-Released(₱)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarifCost as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><span class="fw-semibold">{{ $item['tarif_description'] }}</span></td>
                                        <td><input type="number" class="form-control form-control-sm" min="0" wire:model="tarifCost.{{ $index }}.release_amount"></td>
                                        <td><input type="number" class="form-control form-control-sm" min="0" wire:model="tarifCost.{{ $index }}.unrelease_amount"></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td ></td>
                                    <td ><span class="fw-semibold d-block text-end">Total </span></td>
                                    <td><input type="text" class="form-control form-control-sm" wire:model="releasedTotal" @disabled(true)></td>
                                    <td><input type="text" class="form-control form-control-sm" wire:model="unreleasedTotal" @disabled(true)></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <a class="btn app-btn-primary " wire:click="onCreate">Create</a>
                </div>
            </div>
        </div>
    </div>








































</div>
