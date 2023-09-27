    <div>
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h5 class="app-card-title">LTO Vehicle Registration Details (O.R.)</h5>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                        <div class="card-header-action">
                            @if(Gate::allows('allow-edit','module-fleet-lto-or'))
                                <a href="#" class="fw-bold" wire:click="createLTORegistration"  href="#" data-bs-toggle="modal" data-bs-target="#ltoEditModal">Create</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!--//row-->
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="row mb-3">
                    <div class="app-doc-meta">
                    <table class="table table-sm app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('department_id')" href="#">OR # <x-column-sort direction="{{ $sortdirection }}" for="code" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('requestor')" href="#">OR Date <x-column-sort direction="{{ $sortdirection }}" for="name" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('code')" href="#">Valid Until Date <x-column-sort direction="{{ $sortdirection }}" for="code" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('name')" href="#">Renewal Start Date <x-column-sort direction="{{ $sortdirection }}" for="name" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('code')" href="#">Renewal End Date <x-column-sort direction="{{ $sortdirection }}" for="code" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-lg-none"><a wire:click="sort('name')" href="#">Details <x-column-sort direction="{{ $sortdirection }}" for="name" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell"></th>
                            </tr>
                        </thead>
                        <tbody>

                                @forelse ($registrations as $r)
                                <tr class="">
                                    <td class="cell d-none d-lg-table-cell">{{ $r->or_number }}</td>
                                    <td class="cell d-none d-lg-table-cell">{{ date('F d, Y',strtotime($r->or_date)) }}</td>
                                    <td class="cell d-none d-lg-table-cell">{{ date('F d, Y',strtotime($r->validity_date)) }}</td>
                                    <td class="cell d-none d-lg-table-cell">{{ date('F d, Y',strtotime($r->renewal_start_date)) }}</td>
                                    <td class="cell d-none d-lg-table-cell">{{ date('F d, Y',strtotime($r->renewal_end_date)) }}</td>
                                    <td class="cell d-lg-none">
                                        <span class="fw-bold">OR #: </span> <span>{{ $r->or_number }}</span><br>
                                        <span class="fw-bold">OR Date: </span> <span>{{ date('F d, Y',strtotime($r->or_date)) }}</span><br>
                                        <span class="fw-bold">Valid Until Date: </span> <span>{{ date('F d, Y',strtotime($r->validity_date)) }}</span><br>
                                        <span class="fw-bold">Renewal Start Date: </span> <span>{{ date('F d, Y',strtotime($r->renewal_start_date)) }}</span><br>
                                        <span class="fw-bold">Renewal End Date: </span> <span>{{ date('F d, Y',strtotime($r->renewal_end_date)) }}</span><br>
                                    </td>
                                    <td class="cell text-end">
                                        <a class="btn btn-link link-primary px-1" title="View" href="#" wire:click="editLTORegistration({{$r->id}})" data-bs-toggle="modal" data-bs-target="#ltoEditModal">
                                            <i class="fa-edit fa-solid"></i>
                                        </a>
                                        @if(Gate::allows('allow-delete','module-fleet-lto-or'))
                                        <a class="btn btn-link link-danger px-1" title="Delete"  href="#" wire:click="markDelete({{$r->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fa-trash fa-solid"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-danger text-center" colspan="4">NO DATA</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
            <div class="app-card-footer p-2">
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
                            {{ $registrations->onEachSide(0)->links() }}
                        </div>
                    </div>
                </nav><!--//app-pagination-->
            </div>
        </div><!--//app-card-->

            <!-- Delete Modal -->
    <div wire:ignore class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete O.R. Details</h6>
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

    <div wire:ignore.self class="modal fade" id="ltoEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ltoEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">O.R. Details</h6>
                    <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="or_number" class="form-label small">OR Number<span class="text-danger">*</span></label>
                                <input id="or_number" name="code" wire:model.defer="registration.or_number" type="text" class="form-control form-control-sm" required>
                                @error('registration.or_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="or_date" class="form-label small">OR Date<span class="text-danger">*</span></label>
                            <input id="or_date" name="or_date" wire:model.defer="registration.or_date" type="date" class="form-control form-control-sm" required>
                            @error('registration.or_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="validity_date" class="form-label small">Valid Until Date<span class="text-danger">*</span></label>
                            <input id="validity_date" name="validity_date" wire:model.defer="registration.validity_date" type="date" class="form-control form-control-sm" required>
                            @error('registration.validity_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="ren_start_date" class="form-label small">Renewal Start Date<span class="text-danger">*</span></label>
                            <input id="ren_start_date" name="ren_start_date" wire:model.defer="registration.renewal_start_date" type="date" class="form-control form-control-sm" required>
                            @error('registration.renewal_start_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="ren_end_date" class="form-label small">Renewal End Date<span class="text-danger">*</span></label>
                            <input id="ren_end_date" name="ren_end_date" wire:model.defer="registration.renewal_end_date" type="date" class="form-control form-control-sm" required>
                            @error('registration.renewal_end_date') <span class="text-danger">{{ $message }}</span> @enderror
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
    @push('custom-scripts')
    <script>
        window.livewire.on('close-modal', event => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('ltoEditModal'));
            modal.hide();
        });
    </script>
    @endpush
    </div>
