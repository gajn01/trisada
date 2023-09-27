<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fleet Maintenance</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Fleet Maintenance</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <div class="docs-search-form row gx-1 align-items-center">
                            <div class="col-auto">
                                <input id="search" type="text" wire:model="search"
                                    class="form-control search-docs" placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <!--//col-->
                    @if (Gate::allows('allow-create', 'module-departments'))
                        <div class="col-auto">
                            <a class="btn app-btn-primary" wire:click="create" data-bs-toggle="modal"
                                data-bs-target="#createModal" href="#">
                                Create
                            </a>
                        </div>
                    @endif
                </div>
                <!--//row-->
            </div>
            <!--//table-utilities-->
        </div>
        <!--//col-auto-->
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('vehicles.code')" href="#">Code
                                    <x-column-sort direction="{{ $sortdirection }}" for="vehicles.code"
                                        currentsort="{{ $sortby }}" />
                                </a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('vehicles.make')"
                                    href="#">Name
                                    <x-column-sort direction="{{ $sortdirection }}" for="vehicles.make"
                                        currentsort="{{ $sortby }}" />
                                </a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('vehicles.plate_number')"
                                    href="#">Plate Number
                                    <x-column-sort direction="{{ $sortdirection }}" for="vehicles.plate_number"
                                        currentsort="{{ $sortby }}" />
                                </a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('vehicle_maintenances.start_date')"
                                    href="#">Maintenance Date
                                    <x-column-sort direction="{{ $sortdirection }}" for="vehicle_maintenances.start_date"
                                        currentsort="{{ $sortby }}" />
                                </a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('vehicle_maintenances.end_date')" href="#">End
                                    Date
                                    <x-column-sort direction="{{ $sortdirection }}" for="vehicle_maintenances.end_date"
                                        currentsort="{{ $sortby }}" />
                                </a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('vehicle_maintenances.remarks')"
                                    href="#">Remarks
                                    <x-column-sort direction="{{ $sortdirection }}" for="vehicle_maintenances.remarks"
                                        currentsort="{{ $sortby }}" />
                                </a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('vehicle_maintenances.date_updated')" href="#">Status
                                    <x-column-sort direction="{{ $sortdirection }}" for="vehicle_maintenances.date_updated"
                                        currentsort="{{ $sortby }}" />
                                </a></th>
                            <th class="cell d-lg-none"><a wire:click="sort('vehicles.code')" href="#">Details <x-column-sort direction="{{ $sortdirection }}" for="vehicles.code" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($maintenance_list as $maintenance)
                            <tr class="">
                                <td class="cell d-none d-lg-table-cell"><span>{{ $maintenance->vehicle->code }}</span>
                                </td>
                                <td class="cell d-none d-lg-table-cell">
                                    <span>{{ $maintenance->vehicle->make . ' ' . $maintenance->vehicle->model }}</span>
                                </td>
                                <td class="cell d-none d-lg-table-cell">
                                    <span>{{ $maintenance->vehicle->plate_number }}</span>
                                </td>
                                <td class="cell d-none d-lg-table-cell">
                                    <span>{{ date('F d, Y ', strtotime($maintenance->start_date)) }}</span>
                                </td>
                                <td class="cell d-none d-lg-table-cell">
                                    <span>{{ $maintenance->end_date ? date('F d, Y ', strtotime($maintenance->end_date)) : 'n/a' }}</span>
                                </td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $maintenance->remarks }}</span></td>
                                <td class="cell d-lg-none clickable">
                                    <span class="fw-bold">Name: </span>
                                    <span>{{ $maintenance->vehicle_name }}</span><br>
                                    <span class="fw-bold">Maintenance Date: </span>
                                    <span>{{ date('F d, Y ', strtotime($maintenance->start_date)) }}</span><br>
                                    <span class="fw-bold">End Date: </span>
                                    <span>{{ $maintenance->end_date ? date('F d, Y ', strtotime($maintenance->end_date)) : 'n/a' }}</span><br>
                                    <span class="fw-bold">Remarks: </span>
                                    <span>{{ $maintenance->remarks }}</span><br>
                                </td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $maintenance->statusLabel }}</span>
                                </td>
                                <td class="cell text-end">
                                    <a class="btn btn-link link-primary px-1" title="View"
                                        wire:click="getId({{ $maintenance->id }},true)" data-bs-toggle="modal"
                                        data-bs-target="#createModal">
                                        <i class="fa-edit fa-solid"></i>
                                    </a>
                                    <a class="btn btn-link link-danger px-1" title="Delete" href="#"
                                        wire:click="getId({{ $maintenance->id }},'false')" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        <i class="fa-trash fa-solid"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="8">NO DATA</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="page-utilities d-flex justify-start">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <label for="displaypage">Display</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select-sm w-auto" id="displaypage" wire:model="displaypage">
                            <option selected value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                        <label for="">entries</label>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//table-utilities-->
        </div>
        <div class="col-sm-12 col-md-6">
            <nav class="app-pagination">
                {{ $maintenance_list->onEachSide(0)->links() }}
            </nav>
            <!--//app-pagination-->
        </div>
    </div>
    <div wire:ignore class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Vehicle Maintenance</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="">
                        Do you want to delete selected record?
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" wire:click="delete" class="btn btn-danger text-light"
                        data-bs-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ $isedit ? 'Update' : 'Create' }} Maintenance</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        @if (!$isedit)
                            <div class="mb-3">
                                <label for="vehicle_id" class="form-label ">Vehicle<span
                                    class="text-danger">*</span></label>
                                <select class="form-select form-select-md" name="vehicle_id" id="vehicle_id"
                                    wire:model.defer="vehicle_maintenances.vehicle_id">
                                    <option selected hidden>--Select Vehicle--</option>
                                    @forelse ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">
                                            {{ $vehicle->make . ' ' . $vehicle->model.' ('. $vehicle->plate_number.')'}}
                                        </option>
                                    @empty
                                        <option value="">No data!!</option>
                                    @endforelse
                                </select>
                                @error('vehicle_maintenances.vehicle_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        @endif
                        @if (!$isedit)
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Maintenance Date<span
                                        class="text-danger">*</span></label>
                                <input id="start_date" name="start_date"
                                    wire:model.defer="vehicle_maintenances.start_date" type="date"
                                    class="form-control form-control-md" required min="{{ date('Y-m-d') }}">

                                @error('vehicle_maintenances.start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date<span
                                        class="text-danger">*</span></label>
                                <input id="end_date" name="end_date"
                                    wire:model.defer="vehicle_maintenances.end_date" type="date"
                                    class="form-control form-control-md" min="{{ date('Y-m-d') }}" required>
                                @error('vehicle_maintenances.end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks <span
                                class="text-danger">*</span></label>
                            <textarea class="form-control" name="remarks" id="remarks"
                                wire:model.defer="vehicle_maintenances.remarks"rows="3"></textarea>
                                @error('vehicle_maintenances.remarks')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="save" class="btn btn-primary text-light">Save</button>
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
                        <!-- Session Message -->
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
                    <!-- Session Message -->
                    {{ session('message') }}
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
