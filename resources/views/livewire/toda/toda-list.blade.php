<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Toda Management</li>
        </ol>
    </nav>


    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Toda Management</h1>
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
                    @if (Gate::allows('allow-create', 'module-driver-management'))
                        <div class="col-auto">
                            <a class="btn app-btn-primary" wire:click="onCancel" data-bs-toggle="modal"
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
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="row">

            </div>
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('toda_name')"
                                    href="#">Toda Name <x-column-sort direction="{{ $sortdirection }}"
                                        for="toda_name" currentsort="{{ $sortby }}" /> </a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('toda_address')"
                                    href="#">Toda Address <x-column-sort direction="{{ $sortdirection }}"
                                        for="toda_address" currentsort="{{ $sortby }}" /></a></th>
                            <th class="cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($todaList as $toda)
                            <tr>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $toda->toda_name }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $toda->toda_address }}</span></td>
                                <td class="cell text-end">
                                    @if (Gate::allows('allow-edit', 'module-driver-management'))
                                        <a class="btn btn-link link-primary px-1" title="Update"
                                            wire:click="onGetId({{ $toda->id }},true)" data-bs-toggle="modal"
                                            data-bs-target="#createModal">
                                            <i class="fa-edit fa-solid"></i>
                                        </a>
                                    @endif
                                    @if (Gate::allows('allow-delete', 'module-driver-management'))
                                        <a class="btn btn-link link-danger px-1" title="Delete" href="#"
                                            wire:click="onGetId({{ $toda->id }})" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="fa-trash fa-solid"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="3">NO DATA</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <nav class="app-pagination">
        <div class="row justify-content-between">
            <div class="row col-auto mb-2">
                <div class="col-auto pe-0">Display</div>
                <div class="col-auto">
                    <select id="displaypage" wire:model="displaypage" class="form-select form-select-sm w-auto ">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-auto ps-0">entries</div>
            </div>

            <div class="col-auto mb-2">
                {{ $todaList->onEachSide(1)->links() }}
            </div>
        </div>
    </nav>
    <!--//app-pagination-->
    <!-- Delete Modal -->
    <div wire:ignore class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Toda</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        Do you want to delete selected record?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="onDelete" class="btn btn-danger text-light"
                        data-bs-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ $isedit ? 'Update' : 'Create'}} Toda</h6>
                    <button type="button" wire:click="onCancel" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="onSave">
                        @csrf
                        <div class="settings-form">
                            <div class="mb-2">
                                <label for="toda_name" class="form-label small">Toda Name<span
                                        class="text-danger">*</span></label>
                                <input id="toda_name" name="toda_name" wire:model.defer="toda.toda_name"
                                    type="text" class="form-control form-control-sm" required>
                                @error('toda.toda_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="toda_address" class="form-label small">Toda Address<span
                                        class="text-danger">*</span></label>
                                <textarea id="toda_address" name="toda_address" wire:model.defer="toda.toda_address" class="form-control"
                                    name="" id="" rows="3"></textarea>
                                @error('toda.toda_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="onSave" class="btn btn-primary text-light">{{ $isedit ? 'Update' : 'Save'}}</button>
                    <button type="button" wire:click="onCancel" class="btn btn-secondary" data-bs-dismiss="modal"
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
