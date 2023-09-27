<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Routes Look Up</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Routes Look Up</h1>
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
                    @if(Gate::allows('allow-create','module-route'))
                    <div class="col-auto">
                        <a class="btn app-btn-primary" wire:click="create" data-bs-toggle="modal" data-bs-target="#createModal" href="#">
                            Create
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
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('area')" href="#">Area <x-column-sort direction="{{ $sortdirection }}" for="area" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('concatenate')" href="#">Concatenate <x-column-sort direction="{{ $sortdirection }}" for="concatenate" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('scheme')" href="#">Scheme <x-column-sort direction="{{ $sortdirection }}" for="scheme" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('route_code')" href="#">R.C.<x-column-sort direction="{{ $sortdirection }}" for="route_code" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('km_travelled')" href="#">KM<x-column-sort direction="{{ $sortdirection }}" for="km_travelled" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('liters')" href="#">Liters <x-column-sort direction="{{ $sortdirection }}" for="liters" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('fuel')" href="#">Fuel <x-column-sort direction="{{ $sortdirection }}" for="fuel" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('p_o')" href="#">P.O. <x-column-sort direction="{{ $sortdirection }}" for="p_o" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('fuel_cash_request')" href="#">F.C.R. <x-column-sort direction="{{ $sortdirection }}" for="fuel_cash_request" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('salary')" href="#">Salary <x-column-sort direction="{{ $sortdirection }}" for="salary" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('food_allowance')" href="#">F.A. <x-column-sort direction="{{ $sortdirection }}" for="food_allowance" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('parking')" href="#">Parking<x-column-sort direction="{{ $sortdirection }}" for="parking" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('easytrip')" href="#">Easytrip<x-column-sort direction="{{ $sortdirection }}" for="easytrip" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('autosweep')" href="#">Autosweep<x-column-sort direction="{{ $sortdirection }}" for="autosweep" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('toll_fee')" href="#">Toll Fee<x-column-sort direction="{{ $sortdirection }}" for="toll_fee" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-lg-none"><a wire:click="sort('name')" href="#">Details <x-column-sort direction="{{ $sortdirection }}" for="name" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($routeList as $v)
                            <tr>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->area }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->concatenate }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->scheme }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->route_code }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->km_travelled }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->liters }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->fuel }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->p_o }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->fuel_cash_request }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->salary }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->food_allowance }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->parking }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->easytrip }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->autosweep }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->toll_fee }}</span></td>
                                <td class="cell d-lg-none clickable" onclick="window.location.href = '{{ route('routes-details',[$v->id]) }}'">
                                    <span class="fw-bold">Area: </span> <span>{{ $v->area }}</span><br>
                                    <span class="fw-bold">Concatenate: </span> <span>{{ $v->concatenate }}</span><br>
                                    <span class="fw-bold">Scheme: </span> <span>{{ $v->scheme }}</span><br>
                                    <span class="fw-bold">R.C.: </span> <span>{{ $v->route_code }}</span><br>
                                    <span class="fw-bold">KM: </span> <span>{{ $v->km_travelled }}</span><br>
                                    <span class="fw-bold">Liters: </span> <span>{{ $v->liters }}</span><br>
                                    <span class="fw-bold">Fuel: </span> <span>{{ $v->fuel }}</span><br>
                                    <span class="fw-bold">P.O.: </span> <span>{{ $v->p_o }}</span><br>
                                    <span class="fw-bold">F.C.R.: </span> <span>{{ $v->fuel_cash_request }}</span><br>
                                    <span class="fw-bold">Salary: </span> <span>{{ $v->salary }}</span><br>
                                    <span class="fw-bold">F.A.: </span> <span>{{ $v->food_allowance }}</span><br>
                                    <span class="fw-bold">Parking: </span> <span>{{ $v->parking }}</span><br>
                                    <span class="fw-bold">Easytrip: </span> <span>{{ $v->easytrip }}</span><br>
                                    <span class="fw-bold">Autosweep: </span> <span>{{ $v->autosweep }}</span><br>
                                    <span class="fw-bold">Toll Fee: </span> <span>{{ $v->toll_fee }}</span><br>
                                </td>
                                <td class="cell text-end">
                                    <a class="btn btn-link link-primary px-1" title="View" href="{{ route('routes-details',[$v->id]) }}">
                                        <i class="fa-eye fa-solid"></i>
                                    </a>
                                    @if(Gate::allows('allow-delete','module-transaction'))
                                    <a class="btn btn-link link-danger px-1" title="Delete"  href="#" wire:click="markDelete({{$v->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fa-trash fa-solid"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="15">NO DATA</td>
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
                {{ $routeList->onEachSide(1)->links() }}
            </div>
        </div>
    </nav><!--//app-pagination-->
    <!-- Delete Modal -->
    <div wire:ignore class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Routes</h6>
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
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Routes</h6>
                    <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="type" class="form-label small">Type<span class="text-danger">*</span></label>
                            <select id="type" name="type" wire:model.defer="route.type" class="form-select form-select-sm" required>
                                <option value selected hidden>--Select Transaction--</option>
                                <option value="Pull-out">Pull-out</option>
                                <option value="Regular Deliveries">Regular Deliveries</option>
                                <option value="H.O. Company Vehicles">H.O. Company Vehicles</option>
                                <option value="Others">Others</option>
                            </select>
                            @error('route.type') <span class="text-danger">{{ $message }}</span> @enderror     
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="area" class="form-label small">Area<span class="text-danger">*</span></label>
                                    <input id="area" name="area" wire:model.defer="route.area" type="text" class="form-control form-control-sm" required>
                                    @error('route.area') <span class="text-danger">{{ $message }}</span> @enderror     
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="route_code" class="form-label small">Route Code<span class="text-danger">*</span></label>
                                    <input id="route_code" name="route_code" wire:model.defer="route.route_code" type="text" class="form-control form-control-sm" required>
                                    @error('route.route_code') <span class="text-danger">{{ $message }}</span> @enderror     
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="concatenate" class="form-label small">Concatenate<span class="text-danger">*</span></label>
                                    <input id="concatenate" name="concatenate" wire:model.defer="route.concatenate" type="text" class="form-control form-control-sm" required>
                                    @error('route.concatenate') <span class="text-danger">{{ $message }}</span> @enderror     
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="scheme" class="form-label small">Scheme<span class="text-danger">*</span></label>
                                    <input id="scheme" name="scheme" wire:model.defer="route.scheme" type="text" class="form-control form-control-sm" required>
                                    @error('route.scheme') <span class="text-danger">{{ $message }}</span> @enderror     
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="km_travelled" class="form-label small">KM Travelled<span class="text-danger">*</span></label>
                                    <input id="km_travelled" name="km_travelled" wire:model.defer="route.km_travelled" type="number" class="form-control form-control-sm" required>
                                    @error('route.km_travelled') <span class="text-danger">{{ $message }}</span> @enderror     
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="liters" class="form-label small">Liters<span class="text-danger">*</span></label>
                                    <input id="liters" name="liters" wire:model.defer="route.liters" type="number" class="form-control form-control-sm" required>
                                    @error('route.liters') <span class="text-danger">{{ $message }}</span> @enderror     
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="fuel" class="form-label small">Fuel<span class="text-danger">*</span></label>
                                    <input id="fuel" name="fuel" wire:model.defer="route.fuel" type="number" class="form-control form-control-sm" required>
                                    @error('route.fuel') <span class="text-danger">{{ $message }}</span> @enderror     
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="fuel_cash_request" class="form-label small">Fuel Cash Request</label>
                                    <input id="fuel_cash_request" name="fuel_cash_request" wire:model.defer="route.fuel_cash_request" type="number" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="p_o" class="form-label small">P.O.</label>
                                    <input id="p_o" name="p_o" wire:model.defer="route.p_o" type="number" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="salary" class="form-label small">Salary</label>
                                    <input id="salary" name="salary" wire:model.defer="route.salary" type="number" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="food_allowance" class="form-label small">Food Allowance</label>
                                    <input id="food_allowance" name="food_allowance" wire:model.defer="route.food_allowance" type="number" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="parking" class="form-label small">Parking</label>
                                    <input id="parking" name="parking" wire:model.defer="route.parking" type="number" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="easytrip" class="form-label small">Easytrip</label>
                                    <input id="easytrip" name="easytrip" wire:model.defer="route.easytrip" type="number" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="autosweep" class="form-label small">Autosweep</label>
                                    <input id="autosweep" name="autosweep" wire:model.defer="route.autosweep" type="number" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-2">
                                    <label for="toll_fee" class="form-label small">Toll Fee</label>
                                    <input id="toll_fee" name="toll_fee" wire:model.defer="route.toll_fee" type="number" class="form-control form-control-sm" required>
                                </div>
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
