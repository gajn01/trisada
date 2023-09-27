<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reservation-list')}}">Reservation List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reservation Details</li>
        </ol>
    </nav>
    <h1 class="app-page-title mb-3">Reservation Details</h1>
    <div class="app-card app-card-orders-table text-start p-4 shadow-sm">
        <div class="app-card-body">
            <div class="row">
                <div class="col-12 table-responsive-lg">
                    <table class="table table-borderless small">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <div class="d-flex justify-content-between fs-6">
                                        <span class="cta-color">Booking Number: <span class="text-primary">#{{ str_pad($reservation->id, 10, '0', STR_PAD_LEFT) }}</span></span>
                                        <span class="cta-color">Status: <span @class(['text-warning' => $reservation->status == 0,
                                                                    'text-success' => $reservation->status == 1,
                                                                    'text-success' => $reservation->status > 1,
                                                                    ])>
                                            {{ $reservation->status_string}}</span>
                                        </span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                          {{--   <tr>
                                <td>
                                    <h6 class=" ">Booking Details: </h6>
                                </td>
                            </tr> --}}
                            <tr>
                                <td><span class="fw-semibold">Department: </span><span class="">{{ $reservation->department->name }}</span></td>
                                <td class="d-none d-md-table-cell"><span class="fw-semibold">Pick-up Date/Time: </span><span class="">{{ date('Y-m-d h:i a',strtotime($reservation->pickup_date)) }}</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold">Requested By: </span><span class="">{{ $reservation->created_by->name }}</span></td>
                                <td class="d-none d-md-table-cell"><span class="fw-semibold">Return Date/Time: </span><span class="">{{ date('Y-m-d h:i a',strtotime($reservation->return_date)) }}</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold">Date Requested: </span> <span class="">{{ date('Y-m-d h:i a',strtotime($reservation->date_created)) }}</span> </td>
                                <td class="d-none d-md-table-cell"><span class="fw-semibold">Passenger Count: </span> <span class="">{{ $reservation->head_count }}</span> </td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold">Pick-up Location: </span>
                                    <span class="">{{ $reservation->pickup_location ?  $reservation->pickup_location : '(not yet assigned)' }}</span>
                                </td>
                                <td class="d-none d-md-table-cell"><span class="fw-semibold">Trip Category: </span><span class=""> {{ $reservation->trip_category->description }}</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold">Destination: </span>
                                    @if ($reservation->destination != 0)
                                        <span >{{ $reservation->destination }}</span>
                                    @else
                                        @foreach ($destination_list as $destination)
                                            <span class="fw-semibold"> Trip {{ $destination->order }}</span>
                                            <span class="fw-bold">{!! $destination->destination !!} </span>
                                            @if (!$loop->last)
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell"><span class="fw-semibold">Purpose (Trip Details): </span><span class="">{{ $reservation->purpose }}</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-semibold">Driver: </span> <span class="">
                                    @if($reservation->own_driver || $reservation->company_driver )
                                        @if ($reservation->status == 4 || $reservation->status == 3)
                                            (not yet assigned)
                                            @if ($reservation->status == 2 && auth()->user()->user_type <= 1 ||  Gate::allows('access-enabled','module-reservation-approval') == true )
                                                <span class="cta-color icon" data-bs-toggle="modal" data-bs-target="#changeDriver">(Change)</span>
                                            @endif
                                        @else
                                            {{ $reservation->own_driver == true ? $reservation->own_driver_name->name ?? '(not yet assigned)' : ($reservation->status > 1 ? $reservation->company_driver->name : '(not yet assigned)') }}
                                                @if ($reservation->status == 2 && auth()->user()->user_type <= 1 ||  Gate::allows('access-enabled','module-reservation-approval') == true  )
                                                <span class="cta-color icon" data-bs-toggle="modal" data-bs-target="#changeDriver">(Change)</span>
                                            @endif
                                        @endif
                                    @else
                                        (not yet assigned)
                                        @if ($reservation->status == 2  && auth()->user()->user_type <= 1 ||  Gate::allows('access-enabled','module-reservation-approval') == true )
                                            <span class="cta-color icon" data-bs-toggle="modal" data-bs-target="#changeDriver">(Change)</span>
                                        @endif
                                    @endif
                                   
                                </span> </td>
                                <td class="d-none d-md-table-cell"><span class="fw-semibold">Special Instruction: </span> <span class="">{{ $reservation->special_instruction }}</span> </td>
                            </tr>
                            <tr>
                                <td class="d-none d-md-table-cell"><span class="fw-semibold">Vehicle: </span> <span class="">
                                    @if ($reservation->vehicle)
                                        {{ $reservation->vehicle->make }} {{ $reservation->vehicle->model }} ({{ $reservation->vehicle->plate_number }})
                                        @if ($reservation->status == 2  && auth()->user()->user_type <= 1 ||  Gate::allows('access-enabled','module-reservation-approval') == true )
                                            <span class="cta-color icon" data-bs-toggle="modal" data-bs-target="#changeVehicle">(Change)</span>
                                        @endif
                                    @else
                                        (not yet assigned)
                                        @if ($reservation->status == 2  && auth()->user()->user_type <= 1 ||  Gate::allows('access-enabled','module-reservation-approval') == true )
                                            <span class="cta-color icon" data-bs-toggle="modal" data-bs-target="#changeVehicle">(Change)</span>
                                        @endif
                                    @endif
                                </span> </td>
                            </tr>
                            <tr>
                                <td class="d-md-none"><span class="fw-semibold">Pick-up Date/Time: </span><span class="">{{ date('Y-m-d h:i a',strtotime($reservation->pickup_date)) }}</span></td>
                            </tr>
                            <tr>
                                <td class="d-md-none"><span class="fw-semibold">Return Date/Time: </span><span class="">{{ date('Y-m-d h:i a',strtotime($reservation->return_date)) }}</span></td>
                            </tr>
                            <tr>
                                <td class="d-md-none"><span class="fw-semibold">Passenger Count: </span> <span class="">{{ $reservation->head_count }}</span> </td>
                            </tr>
                            <tr>
                                <td class="d-md-none"><span class="fw-semibold">Trip Distance: </span> <span class="">
                                    {{ $reservation->trip_distance }} Km</span> </td>
                            </tr>
                            <tr>
                                <td class="d-md-none"><span class="fw-semibold">Trip Category: </span><span class="">{{ $reservation->trip_category->description }}</span></td>
                            </tr>
                            <tr>
                                <td class="d-md-none"><span class="fw-semibold">Purpose (Trip Details): </span><span class="">{{ $reservation->purpose }}</span></td>
                            </tr>
                            <tr>
                                <td class="d-md-none"><span class="fw-semibold">Special Instruction: </span> <span class="">{{ $reservation->special_instruction }}</span> </td>
                            </tr>
                            @switch($reservation->status)
                                @case(0)
                                @break
                                @case(1)
                                @break
                                @case(2)
                                    <tr>
                                        <td colspan="2"><hr></td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Booking Approved By: </span> <span class=""> {{ $reservation->booking_approval_by->name ?? '' }} </span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Date Approved: </span> <span class="">{{ date('Y-m-d h:i a',strtotime($reservation->booking_approval_date))}}</span> </td>
                                    </tr>
                                    @break
                                @case(3)
                                    <tr>
                                        <td colspan="2"><hr></td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Declined By: </span> <span class=""> {{ $reservation->declined_by->name }} </span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Date Declined: </span> <span class="">{{ date('Y-m-d h:i a',strtotime($reservation->declined_date))}}</span> </td>
                                    </tr>
                                    <tr>
                                        <td> <span class="fw-semibold">Reason: </span> <span class="">{{ $reservation->decline_reason_description }}</span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Remarks: </span> <span class="">{{ $reservation->remarks}}</span> </td>
                                    </tr>
                                    @break
                                @case(5)
                                    <tr>
                                        <td colspan="2"><hr></td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold"> Approved By: </span> <span class=""> {{ $reservation->booking_approval_by->name }} </span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Date Approved: </span> <span class="">{{ date('Y-m-d h:i a',strtotime($reservation->booking_approval_date))}}</span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Booking Approved By: </span> <span class=""> {{ $reservation->booking_approval_by->name }} </span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Date Approved: </span> <span class="">{{ date('Y-m-d h:i a',strtotime($reservation->booking_approval_date))}}</span> </td>
                                    </tr>
                                    @break
                                @default
                                    <tr>
                                        <td colspan="2"><hr></td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Cancelled By: </span> <span class=""> {{ $reservation->cancelled_by->name }} </span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Date Cancelled: </span> <span class="">{{ date('Y-m-d h:i a',strtotime($reservation->cancellation_date))}}</span> </td>
                                    </tr>
                                    <tr>
                                        <td> <span class="fw-semibold">Reason: </span> <span class="">{{ $reservation->cancel_reason_description }}</span> </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold">Remarks: </span> <span class="">{{ $reservation->remarks}}</span> </td>
                                    </tr>
                                    @break
                            @endswitch
                        </tbody>
                    </table>
                </div>
            </div>
            @if($mode == 2)
                <hr>
                <div class="row">
                    <div class="col-12 col-md-6">
                        {{-- @if ($reservation->destination != 0) --}}
                            <div class="mb-3">
                                <label for="trip_distance" class="form-label ">Trip Distance (Km)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="headcount" id="headcount" wire:model.defer="reservation.trip_distance">
                                @error('reservation.trip_distance')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                    {{--     @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Destination</th>
                                            <th scope="col">km<span class="text-danger">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($destination_list as $index => $destination)
                                            <tr >
                                                <td >  {{$destination->destination}}</td>
                                                <td>
                                                    <input type="number" class="form-control" name="km" id="km" wire:model="destination_list.{{$loop->index}}.km" >
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif --}}
                    </div>
                </div>
                <div class="row">
                    <h6>Select Vehicle</h6>
                    <div class="table-responsive">
                        <table class="table app-table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Plate Number</th>
                                    <th>Coding Dates</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $v)
                                    @php
                                        $cdates =  App\Helpers\AvailabilityHelper::getCodingDates($v->id, $reservation->pickup_date,$reservation->return_date);
                                    @endphp
                                    <tr class="py-2">
                                        <td>{{ $v->code }}</td>
                                        <td>{{ $v->make.' '.$v->model }}</td>
                                        <td>{{ $v->vehicle_type->name}}</td>
                                        <td>{{ $v->plate_number }}</td>
                                        <td>
                                            @forelse ($cdates as $cdate)
                                                <span class="text-danger">{{ $cdate }} </span>@if(count($cdates) > 1)<br>@endif
                                            @empty
                                                None
                                            @endforelse
                                        </td>
                                        <td class="cell text-end p-0">
                                            @if($selectedVehicle == $v->id)
                                                <span class="text-success fw-bold">Selected</span>
                                            @else
                                            <a id="select{{$v->id}}" class="btn btn-primary btn-sm" title="Select" wire:click="selectVehicle({{$v->id}})">
                                                Select
                                            </a>

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @error('selectedVehicle')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
                @if($reservation->own_driver == false)
                    <div class="row">
                        <h6>Select Driver</h6>
                        <div class="table-responsive">
                            <table class="table app-table-hover">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($drivers as $d)
                                        <tr class="py-2">
                                            <td>{{ $d->employee_id }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td class="cell text-end p-0">
                                                @if($selectedDriver == $d->id)
                                                    <span class="text-success fw-bold">Selected</span>
                                                @else
                                                    <a id="selectDriver{{$d->id}}" class="btn btn-primary btn-sm" title="Select" wire:click="selectDriver({{$d->id}})" >
                                                        Select
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @error('selectedDriver')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                @endif
                <div class="d-flex justify-content-end">
                    @if(Gate::allows('access-enabled','module-reservation-approval'))
                        <a class="btn btn-success me-2" wire:click="confirmBooking" href="#">Confirm Booking</a>
                        <a class="btn btn-secondary" wire:click="setMode(0)" href="#">Cancel</a>
                    @endif
                </div>
            @else
                <div class="d-flex justify-content-end">

                    @if($reservation->status == 0)
                        @if(Gate::allows('access-enabled','module-reservation-pre-approval') )
                            <a class="btn btn-success me-2" wire:click="preApprovedBooking">Confirm Pre-Reserve</a>
                            <a class="btn btn-danger" wire:click="setMode(0)" data-bs-toggle="modal" data-bs-target="#cancelReservationModal" href="#">Cancel Reservation</a>
                        @endif
                    @elseif($reservation->status == 1)
                        @if(Gate::allows('access-enabled','module-reservation-approval'))
                            <a class="btn btn-success me-2" wire:click="setMode(2)" href="#">Approve</a>
                            <a class="btn btn-danger" wire:click="setMode(1)" data-bs-toggle="modal" data-bs-target="#declineReservationModal" href="#">Decline</a>
                        @else
                            <a class="btn btn-danger" wire:click="setMode(0)" data-bs-toggle="modal" data-bs-target="#cancelReservationModal" href="#">Cancel Reservation</a>
                        @endif

                    @elseif($reservation->status == 2 && auth()->user()->user_type == 0 || auth()->user()->user_type == 1)
                        <a class="btn btn-success me-2" href="{{ route('trip-create', ['id' => $reservation->id])}}">Create Trip Ticket</a>
                        <a class="btn btn-danger" wire:click="setMode(0)" data-bs-toggle="modal" data-bs-target="#cancelReservationModal" href="#">Cancel Reservation</a>

                    @endif
                </div>
            @endif
        </div>
    </div>
    <!-- Cancel Reservation Modal -->
    <div wire:ignore.self class="modal fade" id="cancelReservationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Cancel Reservation</h6>
                    <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="cancel_reason" class="form-label small">Reason<span class="text-danger">*</span></label>
                            <select id="cancel_reason" name="cancel_reason" wire:model.defer="reservation.cancel_reason" class="form-select form-select-sm" required>
                                <option value selected hidden>--Select Reason--</option>
                                <option value=0>Change of trip schedule.</option>
                                <option value=1>Trip cancelled.</option>
                                <option value=2>Others</option>
                            </select>
                            @error('reservation.cancel_reason') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="remarks" class="form-label small">Description<span class="text-danger">*</span></label>
                            <textarea id="remarks" name="remarks" wire:model.defer="reservation.remarks" type="text" class="form-control form-control-sm" required>
                            </textarea>
                            @error('reservation.remarks') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelReservation" class="btn btn-primary text-light">Confirm Cancellation</button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Decline Reservation Modal -->
    <div wire:ignore.self class="modal fade" id="declineReservationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="declineReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Decline Reservation</h6>
                    <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="decline_reason" class="form-label small">Reason<span class="text-danger">*</span></label>
                            <select id="decline_reason" name="decline_reason" wire:model.defer="reservation.decline_reason" class="form-select form-select-sm" required>
                                <option value selected hidden>--Select Reason--</option>
                                <option value=0>No vehicle available.</option>
                                <option value=1>No driver available.</option>
                                <option value=2>Others</option>
                            </select>
                            @error('reservation.decline_reason') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="remarks" class="form-label small">Description<span class="text-danger">*</span></label>
                            <textarea id="remarks" name="remarks" wire:model.defer="reservation.remarks" type="text" class="form-control form-control-sm" required>
                            </textarea>
                            @error('reservation.remarks') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="declineReservation" class="btn btn-primary text-light">Decline Reservation</button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Change Driver Modal -->
    <div wire:ignore class="modal fade" id="changeDriver" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeDriverLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Change Driver</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="selectedDriver" class="form-label small">Driver </label>
                            <select id="selectedDriver" name="selectedDriver" wire:model.defer="selectedDriver" class="form-select form-select-sm" required>
                                <option value selected hidden>--Select Driver--</option>
                                @foreach($drivers as $d)
                                        <option value="{{ $d->id }}">{{$d->name}} ({{ $d->department->name ?? 'Logistic' }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="updateDriver" class="btn btn-success text-light" data-bs-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
       <!-- Change Vehicle Modal -->
       <div wire:ignore class="modal fade" id="changeVehicle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeVehicleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Change Vehicle</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="selectedVehicle" class="form-label small">Vehicle </label>
                            <select id="selectedVehicle" name="selectedVehicle" wire:model.defer="selectedVehicle" class="form-select form-select-sm" required>
                                <option value selected hidden>--Select Vehicle--</option>
                                @foreach($vehicles as $v)
                                    <option value="{{ $v->id }}">{{ $v->make.' '.$v->model.' '.$v->plate_number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="updateVehicle" class="btn btn-success text-light" data-bs-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('cancelReservationModal'));
                modal.hide();
                var modalb = bootstrap.Modal.getOrCreateInstance(document.getElementById('declineReservationModal'));
                modalb.hide();
            });
            window.livewire.on('show-toast', event => {
                var toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('alertToast'));
                toast.show();
            });
        </script>
    @endpush
</div>
