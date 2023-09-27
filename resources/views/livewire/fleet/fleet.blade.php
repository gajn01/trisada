<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Fleet Management</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Fleet Management</h1>
        </div>
        <div class="col-auto">
             <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <div class="docs-search-form row gx-1 align-items-center">
                            <div class="col-auto">
                                <input id="search" type="text" wire:model="search" class="form-control search-docs" placeholder="Search">
                            </div>
                        </div>
                    </div><!--//col-->
                    @if(Gate::allows('allow-create','module-departments'))
                    <div class="col-auto">
                        <a class="btn app-btn-primary" wire:click="create" data-bs-toggle="modal" data-bs-target="#createModal" href="#">
                            Register Vehicle
                        </a>
                    </div>
                    @endif
                </div><!--//row-->
            </div><!--//table-utilities-->
        </div><!--//col-auto-->
    </div><!--//row-->
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="row">

            </div>
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('code')" href="#">Code <x-column-sort direction="{{ $sortdirection }}" for="code" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('make')" href="#">Make <x-column-sort direction="{{ $sortdirection }}" for="make" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('model')" href="#">Model <x-column-sort direction="{{ $sortdirection }}" for="model" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('fuel_type')" href="#">Fuel Type <x-column-sort direction="{{ $sortdirection }}" for="fuel_type" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('plate_number')" href="#">Plate No. <x-column-sort direction="{{ $sortdirection }}" for="plate_number" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('status')" href="#">Status <x-column-sort direction="{{ $sortdirection }}" for="status" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-lg-none"><a wire:click="sort('id')" href="#">Details <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $v)
                        <tr>
                            <td class="cell d-none d-lg-table-cell"><span>{{ $v->code }}</span></td>
                            <td class="cell d-none d-lg-table-cell"><span>{{ $v->make }}</span></td>
                            <td class="cell d-none d-lg-table-cell"><span>{{ $v->model }}</span></td>
                            <td class="cell d-none d-lg-table-cell"><span>{{ $v->fuel_type }}</span></td>
                            <td class="cell d-none d-lg-table-cell"><span>{{ $v->plate_number }}</span></td>
                            <td class="cell d-none d-lg-table-cell">
                                <span @class(['badge',
                                            'bg-danger' => $v->status == 0,
                                            'bg-success' => $v->status == 1,
                                            'bg-secondary' => $v->status == 2])>
                                    {{ $v->status_string }}
                                </span>
                            </td>
                            <td class="cell d-lg-none clickable" onclick="window.location.href = '{{ route('fleet-details',[$v->id]) }}'">
                                <span class="fw-bold">Code: </span> <span>{{ $v->code }}</span><br>
                                <span class="fw-bold">Make: </span> <span>{{ $v->make }}</span><br>
                                <span class="fw-bold">Model: </span> <span>{{ $v->model }}</span><br>
                                <span class="fw-bold">Fuel Type: </span> <span>{{ $v->fuel_type }}</span><br>
                                <span class="fw-bold">Plate No.: </span> <span>{{ $v->plate_number }}</span><br>
                                <span class="fw-bold">Status: </span> <span>{{ $v->status }}</span><br>
                            </td>
                            <td class="cell text-end">
                                <a class="btn btn-link link-primary px-1" title="View" href="{{ route('fleet-details',[$v->id]) }}">
                                    <i class="fa-eye fa-solid"></i>
                                </a>
                                @if(Gate::allows('allow-delete','module-fleet-management'))
                                <a class="btn btn-link link-danger px-1" title="Delete"  href="#" wire:click="markDelete({{$v->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fa-trash fa-solid"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-danger text-center" colspan="7">NO DATA</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!--//table-responsive-->
        </div><!--//app-card-body-->
    </div><!--//app-card-->
    <nav class="app-pagination">
        <div class="row justify-content-between">
            <div class="row col-auto mb-2">
                <div class="col-auto pe-0">Display</div>
                <div class="col-auto">
                    <select id="displaypage" wire:model="displaypage" class="form-select form-select-sm w-auto ">
                        <option value="10">10</option>
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </select>
                </div>
                <div class="col-auto ps-0">entries</div>
            </div>

            <div class="col-auto mb-2">
                {{ $vehicles->onEachSide(1)->links() }}
            </div>
        </div>
    </nav><!--//app-pagination-->
    <!-- Delete Modal -->
    <div wire:ignore class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Department</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="">
                        Do you want to delete selected record?
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" wire:click="delete" class="btn btn-danger text-light" data-bs-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Register Vehicle</h6>
                    <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="code" class="form-label small">Code<span class="text-danger">*</span></label>
                                <input id="code" name="code" wire:model.defer="vehicle.code" type="text" class="form-control form-control-sm" required>
                                @error('vehicle.code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="make" class="form-label small">Make<span class="text-danger">*</span></label>
                            <input id="make" name="make" wire:model.defer="vehicle.make" type="text" class="form-control form-control-sm" required>
                            @error('vehicle.make') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="model" class="form-label small">Model<span class="text-danger">*</span></label>
                            <input id="model" name="model" wire:model.defer="vehicle.model" type="text" class="form-control form-control-sm" required>
                            @error('vehicle.model') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 col-lg-6">
                                <label for="vehicle_type_id" class="form-label small">Vehicle Type<span class="text-danger">*</span></label>
                                <select id="vehicle_type_id" name="vehicle_type_id" class="form-select form-select-sm" wire:model.defer="vehicle.vehicle_type_id">
                                    <option selected hidden>--Select Vehicle Type--</option>
                                    @foreach ($vehicle_types as $type )
                                    <option value="{{ $type->id}}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle.vehicle_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="coding_day" class="form-label small">Coding Day<span class="text-danger">*</span></label>
                                <select id="coding_day" name="coding_day" class="form-select form-select-sm" wire:model.defer="vehicle.coding_day">
                                    <option selected hidden>--Select Coding Day--</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">NA</option>
                                </select>
                                @error('vehicle.coding_day') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 col-lg-6">
                                <label for="plate_number" class="form-label small">Plate Number<span class="text-danger">*</span></label>
                                <input id="plate_number" name="plate_number" wire:model.defer="vehicle.plate_number" type="text" class="form-control form-control-sm" required>
                                @error('vehicle.plate_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="passenger_capacity" class="form-label small">Passenger Capacity<span class="text-danger">*</span></label>
                                <input id="passenger_capacity" name="passenger_capacity" wire:model.defer="vehicle.passenger_capacity" type="number" class="form-control form-control-sm" required>
                                @error('vehicle.passenger_capacity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 col-lg-6">
                                <label for="fuel_type" class="form-label small">Fuel Type<span class="text-danger">*</span></label>
                                <select id="fuel_type" name="fuel_type" class="form-select form-select-sm" wire:model.defer="vehicle.fuel_type">
                                    <option selected hidden>--Select Fuel Type--</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Diesel">Diesel</option>
                                </select>
                                @error('vehicle.fuel_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="fuel_capacity" class="form-label small">Fuel Capacity (liters) <span class="text-danger">*</span></label>
                                <input id="fuel_capacity" name="fuel_capacity" wire:model.defer="vehicle.fuel_capacity" type="number" class="form-control form-control-sm" required>
                                @error('vehicle.fuel_capacity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="save" class="btn btn-primary text-light">Save</button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" >Close</button>
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
        window.livewire.on('close-modal', event => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
            modal.hide();
        });
        window.livewire.on('show-toast', event => {
            var toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('alertToast'));
            toast.show();
        });

    </script>
    @endpush
</div>
