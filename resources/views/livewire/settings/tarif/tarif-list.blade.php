<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tarif</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Tarif</h1>
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
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('description')" href="#">Description <x-column-sort direction="{{ $sortdirection }}" for="description" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-lg-none"><a wire:click="sort('name')" href="#">Details <x-column-sort direction="{{ $sortdirection }}" for="name" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tarifList as $v)
                            <tr>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $v->description }}</span></td>
                                <td class="cell d-lg-none clickable" onclick="window.location.href = '{{ route('tarif-details',[$v->id]) }}'">
                                    <span class="fw-bold">Description: </span> <span>{{ $v->description }}</span><br>
                                </td>
                                <td class="cell text-end">
                                    <a class="btn btn-link link-primary px-1" title="View" href="{{ route('tarif-details',[$v->id]) }}">
                                        <i class="fa-eye fa-solid"></i>
                                    </a>
                                    @if(Gate::allows('allow-delete','module-tarif'))
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
                {{ $tarifList->onEachSide(1)->links() }}
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
        <div class="modal-dialog   modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create Routes</h6>
                    <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="description" class="form-label small">Description<span class="text-danger">*</span></label>
                            <input id="description" name="description" wire:model.defer="tarif.description" type="text" class="form-control form-control-sm" required>
                            @error('tarif.description') <span class="text-danger">{{ $message }}</span> @enderror     
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
