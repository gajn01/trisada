<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reserve Vehicle</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Reserve Vehicle</h1>
        </div>
    </div><!--//row-->
    <div class="app-card text-start shadow-sm p-4">
        <div class="app-card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                <select class="form-select form-select-md" name="department" id="department" wire:model="reservation.department_id">
                                    <option value hidden selected>--Select Department--</option>
                                    @foreach ($department_list as $departments)
                                        <option value="{{ $departments->id }}">{{ $departments->name }}</option>
                                    @endforeach
                                </select>
                                @error('reservation.department_id')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="driver" class="form-label">Driver: <span class="text-danger">*</span></label>
                                <div class="form-check  form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioGroup" id="radio1" wire:model="driver_option" value="withDriver">
                                    <label class="form-check-label small" for="radio1">Own Driver</label>
                                </div>
                                <div class="form-check  form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioGroup" id="radio2" wire:model="driver_option" value="companyDriver">
                                    <label class="form-check-label small" for="radio2">Company</label>
                                </div>
                                @if($driver_option == 'withDriver')
                                   {{--  <input type="text" class="form-control" name="driver" placeholder="Driver Name" id="driver" wire:model.defer="reservation.driver">
                                    @error('reservation.driver')<span class="text-danger mt-1">{{ $message }}</span>@enderror --}}
                                    <select class="form-select form-select-md" name="driver" id="driver" wire:model.defer="reservation.driver" >
                                        <option value hidden selected>--Select Driver--</option>
                                        @forelse ($driver_list as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @empty
                                            <option selected value="">No Registered Driver</option>
                                        @endforelse
                                    </select>
                                @error('reservation.driver')<span class="text-danger mt-1">{{ $message }}</span>@enderror

                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="headcount" class="form-label ">Passenger Count <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="headcount" id="headcount" wire:model.defer="reservation.head_count" min="0">
                                @error('reservation.head_count')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="trip_distance" class="form-label ">Trip Category <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-md" name="trip_category" id="trip_category" wire:model.defer="reservation.trip_category_id">
                                        <option value hidden selected>--Select Trip Category--</option>
                                        @foreach ($trip_categories as $t)
                                            <option value="{{ $t->id }}">{{ $t->description }}</option>
                                        @endforeach
                                    </select>
                                @error('reservation.trip_category_id')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose (Trip Details)<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="purpose" id="purpose" rows="3" wire:model.defer="reservation.purpose"></textarea>
                                @error('reservation.purpose') <span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="special_instruction" class="form-label">Special Instruction</label>
                                <textarea class="form-control" name="special_instruction" id="special_instruction" rows="3" wire:model.defer="reservation.special_instruction"></textarea>
                                @error('reservation.special_instruction')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="pickup_date" class="form-label">Pickup Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="pickup_date" id="pickup_date" wire:model.defer="reservation.pickup_date" min="{{ date('Y-m-d h') }}" step="1800">
                                @error('reservation.pickup_date')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="return_date" class="form-label">Return Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="return_date" id="return_date" wire:model.defer="reservation.return_date" min="{{ date('Y-m-d h')}}" step="1800">
                                @error('reservation.return_date')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="toggle-switch">Multiple Trip</label>
                                <input class="form-check-input" type="checkbox" id="toggle-switch" wire:model="is_multiple_trip"  >
                            </div>
                        </div>
                        <div @class(['col-12','col-md-6' => $is_multiple_trip == false])>
                            <div class="mb-3">
                                <label for="pickup_location" class="form-label">Pick-up Location<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pickup_location" id="pickup_location" wire:model.defer="reservation.pickup_location">
                                @error('reservation.pickup_location')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if ($is_multiple_trip)
                            <div class="mb-3">
                                <div class="row">
                                    <label for="destination" class="form-label">Destination</label>
                                    <div class="col-sm-12 col-md-10 mb-3">
                                        <input type="text" class="form-control" name="destination" id="destination" wire:model.defer="destination" required >
                                    </div>
                                    @error('destination')<span class="text-danger mt-1">{{ $message }}</span>@enderror

                                    <div class="col-sm-12 col-md-2 ">
                                        <a name="" id="" class="btn cta-bg " role="button" wire:click="addDestination">Add</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <ul>
                                    @forelse ($destination_trips as $item)
                                        <li>
                                            {{$item['destination']}}
                                        </li>
                                    @empty
                                        <li>
                                            No Destination Found!
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        @else
                            <div @class(['col-12','col-md-6' => $is_multiple_trip == false])>
                                <div class="mb-3">
                                    <label for="destination" class="form-label">Destination<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="destination" id="destination"  wire:model.defer="reservation.destination">
                                    @error('reservation.destination')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        @endif
                      
                     
                        <div class="col-12">
                            <a id="reserve" name="reserve" class="btn app-btn-primary float-end" wire:click="save" href="#">Submit Reservation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="alertToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="" class="rounded me-2" alt="">
                <strong class="me-auto">
                    @if(session()->has('title')) <!-- Session Message -->
                        <span class="{{ $class }}">{{ session('title') }}</span>
                    @endif
                </strong>
                <small>
                    @if(session()->has('timestamp'))
                    {{ session('timestamp') }}
                    @endif
                </small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                @if(session()->has('message')) <!-- Session Message -->
                {{ session('message')  }}
                @endif
            </div>
        </div>
    </div>
    @push('custom-scripts')
    <script>
        window.livewire.on('show-toast', event => {
            var toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('alertToast'));
            toast.show();
        });
    </script>
    @endpush
</div>
