<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
            <li class="breadcrumb-item"><a href="{{ route('trip') }}">Trip Tickets</a>
            <li class="breadcrumb-item active" aria-current="page">Trip Ticket Details</li>
        </ol>
    </nav>
    <h1 class="app-page-title mb-3 ">Trip Ticket Details</h1>
    <div class="app-card app-card-orders-table text-start p-4 shadow-sm">
        <div class="app-card-body">
            <div class="row justify-content-between align-items-center mb-4">
                <div class="col-3 border-end border-2 border-secondary">
                    <h6 class="cta-color">Trip ID</h6>
                    <span class="item fw-semibold text-primary">
                        #{{ str_pad($trip_data->id, 10, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
                <div class="col-3 border-end border-2 border-secondary">
                    <h6 class="cta-color">Departure</h6>
                    <span class="item fw-semibold text-primary">
                        {{ date('Y-m-d h:i a', strtotime($trip_data->reservation->pickup_date)) }}
                    </span>
                </div>
                <div class="col-3 border-end border-2 border-secondary">
                    <div class="card-header-action">
                        <h6 class="cta-color">Expected Arrival</h6>
                        <span class="item fw-semibold text-primary">
                            {{ date('Y-m-d h:i a', strtotime($trip_data->reservation->return_date)) }}
                        </span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card-header-action">
                        <h6 class="cta-color">Status</h6>
                        <span class="item fw-semibold text-primary">
                            {{ $trip_data->StatusString }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{-- Reservation Details --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Booking Details</h5>
                        </div>
                        <div class="col-sm-">
                            <span class="fw-semibold">Booking Number: </span> 
                            <span class="">{{ $trip_data->reservation->id }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Requested By: </span> 
                            <span class="">{{ $trip_data->reservation->created_by->name }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Requested By: </span> 
                            <span class="">{{ $trip_data->reservation->department->name }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Passenger Count: </span> 
                            <span class="">{{ $trip_data->reservation->head_count }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Trip Category: </span> 
                            <span class="">{{ $trip_data->reservation->trip_category->description }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Purpose (Trip Details): </span> 
                            <span class="">{{ $trip_data->reservation->purpose }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Special Instruction:: </span> 
                            <span class="">{{ $trip_data->reservation->special_instruction }}</span>
                        </div>
                    </div>
                    {{-- Vehicle & Driver Details --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Vehicle & Driver Details</h5>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Vehicle Code: </span> <span
                                class="">{{ $trip_data->reservation->vehicle->code }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Fuel Cap: </span> <span
                                class="">{{ $trip_data->reservation->vehicle->fuel_capacity }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Vehicle Model: </span> <span
                                class="">{{ $trip_data->reservation->vehicle->model }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Fuel Type: </span> <span
                                class="">{{ $trip_data->reservation->vehicle->fuel_type }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Vehicle Type: </span> <span
                                class="">{{ $trip_data->reservation->vehicle->vehicle_type->name }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Chasis No.: </span> <span
                                class="">{{ $trip_data->reservation->vehicle->chassis_number }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Driver`s Name: </span> <span
                                class="">{{ $trip_data->reservation->own_driver_name->name ?? '' }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Driver`s Department: </span> <span
                                class="">{{ $trip_data->reservation->own_driver_name->department->name ?? 'Logistic' }}</span>
                        </div>
                    </div>
                    {{-- Routes Details --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Routes Details</h5>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Origin: </span> <span
                                class="">{{ $trip_data->reservation->pickup_location }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Destination Route: </span> <span class="">
                                @forelse ($destination_list as $destination)
                                    <span class="fw-semibold"> Trip {{ $destination->order }}</span>
                                    <span class="fw-bold">{{$destination->destination}} </span>
                                    @if (!$loop->last)
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path
                                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                                        </svg>
                                    @endif
                                @empty
                                    {{ $trip_data->reservation->destination }}
                                @endforelse
                            </span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="fw-semibold">Distance: </span> 
                            <span class="">{{ $trip_data->reservation->trip_distance }} km</span>
                        </div>
                    </div>
                    {{-- Tarif Cost Details --}}
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-3">Tariff Details</h5>
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
                                                <td>{{ $index + 1 }} </td>
                                                <td><span class="fw-semibold">{{ $item['tarif_description'] }}</span></td>
                                                <td><input type="number" class="form-control form-control-sm" wire:model="tarifCost.{{ $index }}.release_amount" @disabled( $trip_data->status != 2 ? false : true )></td>
                                                <td><input type="number" class="form-control form-control-sm" wire:model="tarifCost.{{ $index }}.unrelease_amount" @disabled( $trip_data->status != 2 ? false : true )></td>
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
                    </div>
                    {{-- Trip Release Details --}}
                    @if ($trip_data->status >= 1 && $trip_data->status != 3)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">Released Details</h5>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="col-sm-12 ">
                                    <span class="fw-semibold">Trip Released By: </span>
                                    <span class="">{{ $trip_data->released_by->name }}</span>
                                </div>
                                <div class="col-sm-12 ">
                                    <span class="fw-semibold">Released Date: </span> 
                                    <span class="">{{ date('Y-m-d h:i a', strtotime($trip_data->release_date)) }}</span>
                                </div>
                                <div class="col-sm-12">
                                    <span class="fw-semibold">Initial Odometer Reading:</span> 
                                    <span class="">{{$trip_data->initial_odometer_reading  }}</span>
                                </div>
                                <div class="col-sm-12">
                                    <span class="fw-semibold">Intial Fuel Bar: </span> 
                                    <span class="">{{$trip_data->FuelBarLabel  }}</span>
                                </div>
                                <div class="col-sm-12 ">
                                    <span class="fw-semibold">Received By: </span> 
                                    <span class="">{{ $trip_data->received_by }}</span>
                                </div>
                            </div>
                            @if ($trip_data->status == 2)
                                <div class="col-sm-12 col-md-6">
                                    <div class="col-sm-12 ">
                                        <span class="fw-semibold">Trip Closed By: </span>
                                        <span class="">{{ $trip_data->closed_by->name }}</span>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <span class="fw-semibold">Returned Date: </span> 
                                        <span class="">{{ date('Y-m-d h:i a', strtotime($trip_data->return_date)) }}</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="fw-semibold">Final Odometer Reading:</span> 
                                        <span class="">{{$trip_data->final_odometer_reading  }}</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="fw-semibold">Final Fuel Bar: </span> 
                                        <span class="">{{$trip_data->FinalFuelBarLabel  }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($trip_data->status == 0)
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <a class="btn btn-warning ms-2 mx-2" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel Ticket</a>

                        @if (Gate::allows('access-enabled', 'module-trip-ticket-releasing'))
                            <a class="btn app-btn-primary" data-bs-toggle="modal"
                                data-bs-target="#releaseVehicleModal">Release</a>
                        @endif
                    </div>
                @else
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <a class="btn btn-primary" href="{{ route('trip-ticket-print', $trip_data->id) }}">Print
                            Trip Ticket</a>
                        @if (Gate::allows('access-enabled', 'module-trip-ticket-closing'))
                            @if ($trip_data->status == 1)
                                <a class="btn app-btn-primary ms-2" data-bs-toggle="modal"
                                    data-bs-target="#closeTicketModal">Close Ticket</a>
                            @endif
                        @endif
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
      <!-- cancell Modal -->
      <div wire:ignore class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Cancel Trip Ticket</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="">
                        Do you want to cancel selected trip?
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" wire:click="onCancelTripTicket" class="btn btn-danger text-light" data-bs-dismiss="modal">Cancel trip</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="releaseVehicleModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="releaseVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Release Vehicle</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (Gate::allows('access-enabled', 'module-trip-ticket-releasing'))
                        <div class="mb-3">
                            <label for="driver" class="form-label mb-0">Initial Odometer Reading:</label>
                            <input type="text" class="form-control" name="driver" id="driver" wire:model="initial_odometer_reading">
                        </div>
                        <div class="mb-3">
                            <label for="fuelGauge" class="form-label">Fuel Gauge</label>
                            <input type="range" class="form-range" min="0" max="4" id="fuelGauge"  wire:model="initial_fuel_bar">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Empty</span>
                                <span>Low</span>
                                <span>Half</span>
                                <span>Almost Full</span>
                                <span>Full</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="received_by" class="form-label fs- mb-0">Received By: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="received_by" id="received_by" wire:model="received_by">
                            @error('received_by')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="release" class="btn btn-primary text-light">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="closeTicketModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="closeTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Close Trip Ticket</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (Gate::allows('access-enabled', 'module-trip-ticket-releasing'))
                        <div class="mb-3">
                            <label for="return_date" class="form-label mb-0">Returned Date & Time: <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="return_date" id="return_date" wire:model="return_date">
                            @error('return_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="final_odo" class="form-label mb-0">Final Odometer Reading: </label>
                            <input type="text" class="form-control" name="final_odo" id="final_odo" wire:model="final_odometer_reading">
                        </div>
                        <div class="mb-3">
                            <label for="final_fuel" class="form-label">Fuel Gauge</label>
                            <input type="range" class="form-range" min="0" max="4" id="final_fuel"
                                wire:model="final_fuel_bar">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Empty</span>
                                <span>Low</span>
                                <span>Half</span>
                                <span>Almost Full</span>
                                <span>Full</span>
                            </div>
                            @error('final_fuel_bar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="close" class="btn btn-primary text-light">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="alertToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="" class="rounded me-2" alt="">
                <strong class="me-auto">
                    @if (session()->has('title'))
                        <span class="{{ $class }}">{{ session('title') }}</span>
                    @endif
                </strong>
                <small>
                    @if (session()->has('timestamp'))
                        {{ session('timestamp') }}
                    @endif
                </small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                @if (session()->has('message'))
                    {{ session('message') }}
                @endif
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script>
            window.livewire.on('close-modal', event => {
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('releaseVehicleModal'));
                modal.hide();
                var modalb = bootstrap.Modal.getOrCreateInstance(document.getElementById('closeTicketModal'));
                modalb.hide();
            });
            window.livewire.on('show-toast', event => {
                var toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('alertToast'));
                toast.show();
            });
        </script>
    @endpush
</div>
