<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('fleet-management') }}">Fleet Management</a>
          <li class="breadcrumb-item active" aria-current="page">Fleet Details</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Vehicle Details</h1>
        </div>
    </div><!--//row-->
    <div class="row">
        <div class="col-12 col-lg-6 mb-2">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h5 class="app-card-title">Basic Details</h5>
                        </div>
                        <div class="col-auto">
                            <div class="card-header-action">
                                @if(Gate::allows('allow-edit','module-fleet-management'))
                                    @if($editMode == 0)
                                    <a href="#" class="fw-bold" wire:click="updateBasicDetails">Update</a>
                                    @endif
                                    @if($editMode == 1)
                                    <a href="#" class="link-primary fw-bold" wire:click="saveBasicDetails">Save</a> |
                                    <a href="#" class="link-danger fw-bold" wire:click="cancel" >Cancel</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="row">
                        <div class="app-doc-meta">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td  style="width:12em">
                                            <span class="fs-6">Code:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <input id="code" name="code" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.code" />
                                            @error('vehicle.code') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->code }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  style="width:12em">
                                            <span class="fs-6">Make:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <input id="make" name="make" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.make" />
                                            @error('vehicle.make') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->make }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Model:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <input id="model" name="model" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.model" />
                                            @error('vehicle.model') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->model }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Type:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <select id="vehicle_type_id" name="vehicle_type_id" class="form-select form-select-sm" wire:model.defer="vehicle.vehicle_type_id">
                                                <option selected hidden>--Select Vehicle Type--</option>
                                                @foreach ($vehicle_types as $type )
                                                <option value="{{ $type->id}}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle.vehicle_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->vehicle_type->name }}</span>
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Plate No.:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <input id="plate_number" name="plate_number" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.plate_number" />
                                            @error('vehicle.plate_number') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->plate_number}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Passenger Capacity:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <input id="passenger_capacity" name="plate_number" type="number" class="form-control form-control-sm" wire:model.defer="vehicle.passenger_capacity" />
                                            @error('vehicle.passenger_capacity') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->passenger_capacity }} Seater</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Fuel Type:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <select id="fuel_type" name="fuel_type" class="form-select form-select-sm" wire:model.defer="vehicle.fuel_type">
                                                <option selected hidden>--Select Fuel Type--</option>
                                                <option value="Gas">Gas</option>
                                                <option value="Diesel">Diesel</option>
                                            </select>
                                            @error('vehicle.fuel_type') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->fuel_type }}</span>
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Fuel Capacity:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <input id="fuel_capacity" name="fuel_capacity" type="number" wire:model.defer="vehicle.fuel_capacity"  class="form-control form-control-sm" >
                                            @error('vehicle.fuel_capacity') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->fuel_capacity }} liter(s)</span>
                                            @endif


                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Coding Day:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 1)
                                            <select id="coding_day" name="coding_day" class="form-select form-select-sm" wire:model.defer="vehicle.coding_day">
                                                <option selected hidden>--Select Coding Day--</option>
                                                <option value="1">Monday</option>
                                                <option value="2">Tuesday</option>
                                                <option value="3">Wednesday</option>
                                                <option value="4">Thursday</option>
                                                <option value="5">Friday</option>
                                                <option value="7">NA</option>
                                            </select>
                                            @error('vehicle.coding_day') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->coding_day_string }}</span>
                                            @endif

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->
        </div>
        <div class="col-12 col-lg-6 mb-2">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h5 class="app-card-title">LTO Vehicle Registration Details (C.R.)</h5>
                        </div>
                        <!--//col-->
                        <div class="col-auto">
                            <div class="card-header-action">
                                @if(Gate::allows('allow-edit','module-fleet-management'))
                                    @if($editMode == 0)
                                    <a href="#" class="fw-bold" wire:click="updateRegistrationDetails">Update</a>
                                    @endif
                                    @if($editMode == 2)
                                    <a href="#" class="link-primary fw-bold" wire:click="saveRegistrationDetails">Save</a> |
                                    <a href="#" class="link-danger fw-bold" wire:click="cancel">Cancel</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="row">
                        <div class="app-doc-meta">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="width:12em">
                                            <span class="fs-6">MV File No:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 2)
                                            <input id="mv_file_number" name="mv_file_number" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.mv_file_number" />
                                            @error('vehicle.mv_file_number') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->mv_file_number }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">C.R. No:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 2)
                                            <input id="cr_number" name="cr_number" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.cr_number" />
                                            @error('vehicle.cr_number') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->cr_number }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Registration Date:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 2)
                                            <input id="registration_date" name="registration_date" type="date" class="form-control form-control-sm" wire:model.defer="vehicle.registration_date" />
                                            @error('vehicle.registration_date') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ empty($vehicle->registration_date) ? '' : date('Y-m-d',strtotime($vehicle->registration_date)) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Engine No:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 2)
                                            <input id="engine_number" name="engine_number" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.engine_number" />
                                            @error('vehicle.engine_number') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->engine_number }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Chassis No.:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 2)
                                            <input id="chassis_number" name="chassis_number" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.chassis_number" />
                                            @error('vehicle.chassis_number') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->chassis_number }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fs-6">Color:</span>
                                        </td>
                                        <td>
                                            @if($editMode == 2)
                                            <input id="colour" name="colour" type="text" class="form-control form-control-sm" wire:model.defer="vehicle.color" />
                                            @error('vehicle.color') <span class="text-danger">{{ $message }}</span> @enderror
                                            @else
                                            <span class="fw-bold fs-6">{{ $vehicle->color }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-4">
    @livewire('fleet.sub-lto-vehicle-registration',['id' => $this->vehicle->id])


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
