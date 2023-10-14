<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Toda Admin Management</li>
        </ol>
    </nav>

    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Toda Admin Management</h1>
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
                    <div class="col-auto">
                        <a class="btn app-btn-primary" wire:click="onCancel" data-bs-toggle="modal"
                            data-bs-target="#createModal" href="#">
                            Register
                        </a>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//table-utilities-->
        </div>
    </div>
    {{-- <img src="{{ asset('storage/img/E4oc0BORjAexTmQIKiWgOxH0mDDGDT19Dp8bgc6y.jpg') }}" alt="User Avatar"> --}}
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="row">

            </div>
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">ID</th>
                            <th class="cell">Name</th>
                            <th class="cell">Status</th>
                            <th class="cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accountList as $list)
                            <tr>
                                <td class="cell d-none d-lg-table-cell"> <span>{{ $list->id }}</span> </td>
                                <td class="cell d-none d-lg-table-cell"> <span>{{ $list->firstname .' '. $list->lastname }}</span> </td>
                                <td class="cell d-none d-lg-table-cell"> <span>{{ $list->status }} </span></td>
                                <td class="cell text-end">
                                    <a class="btn btn-link link-primary px-1" title="View"
                                        href="{{ route('admin-details', ['id' => $list->id]) }}">
                                        <i class="fa-eye fa-solid"></i>
                                    </a>
                                    <a class="btn btn-link link-danger px-1" title="Delete" href="#"
                                        wire:click="onGetId({{ $list->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fa-trash fa-solid"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="4">NO DATA</td>
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
                {{ $accountList->onEachSide(1)->links() }}
            </div>
        </div>
    </nav>
    <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Register Toda Admin</h6>
                <button type="button" wire:click="onCancel" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="save">
                    @csrf
                    <div class="settings-form">
                        <label class="fw-bold" for="">Personal Information</label>
                        <hr />
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <label for="user.firstname" class="form-label">First Name<span
                                        class="text-danger">*</span></label>
                                <input id="user.firstname" name="user.firstname"
                                    wire:model.defer="user.firstname" type="text"
                                    class="form-control form-control-sm" required>
                                @error('user.firstname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="user.midname" class="form-label">Middle Name</label>
                                <input id="user.midname" name="user.midname" wire:model.defer="user.midname"
                                    type="text" class="form-control form-control-sm">
                                @error('user.midname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="user.lastname" class="form-label">Last Name<span
                                        class="text-danger">*</span></label>
                                <input id="user.lastname" name="user.lastname" wire:model.defer="user.lastname"
                                    type="text" class="form-control form-control-sm" required>
                                @error('user.lastname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label for="user.birthday" class="form-label">Birthday</label>
                                <input id="user.birthday" name="user.birthday" wire:model.defer="user.birthday"
                                    type="date" class="form-control form-control-sm">
                                @error('user.birthday')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="user.age" class="form-label">Age</label>
                                <input id="user.age" name="user.age" wire:model.defer="user.age" type="number"
                                    class="form-control form-control-sm">
                                @error('user.age')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label for="user.contact_no" class="form-label">Contact Number<span
                                        class="text-danger">*</span></label>
                                <input id="user.contact_no" name="user.contact_no"
                                    wire:model.defer="user.contact_no" type="number"
                                    class="form-control form-control-sm" required>
                                @error('user.contact_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="user.email" class="form-label">Email Address<span
                                        class="text-danger">*</span></label>
                                <input id="user.email" name="user.email" wire:model.defer="user.email"
                                    type="email" class="form-control form-control-sm" required>
                                @error('user.email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="user.address" class="form-label">Address</label>
                                <textarea id="user.address" name="user.address" wire:model.defer="user.address" class="form-control form-control-sm"
                                    rows="3"></textarea>
                                @error('user.address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="mb-2 ">
                                    <label for="user.img" class="form-label">Image</label>
                                    <input type="file" wire:model="photo">
                                    @error('photo')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <label class="fw-bold" for="">Account Information</label>
                        <hr />
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label for="user.username" class="form-label">Username</label>
                                <input id="user.username" name="user.username" wire:model.defer="user.username"
                                    type="text" class="form-control form-control-sm">
                                @error('user.username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="user.password" class="form-label">Password</label>
                                <input id="user.password" name="user.password" wire:model.defer="user.password"
                                    type="password" class="form-control form-control-sm">
                                @error('user.password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <label class="fw-bold" for="">Toda Information</label>
                        <hr />
                        <div class="mb-2  d-flex flex-column">
                            <label for="toda_id" class="form-label">Toda</label>
                            <select name="toda_id" id="toda_id" class="form-select form-select-md  d-inline-flex w-auto" wire:model="user.toda_id"
                            @disabled(auth()->user()->user_type == 0 ? false : true)>
                                <option value hidden selected>--Select Toda--</option>
                                @foreach ($todaList as $toda)
                                    <option value="{{$toda->id}}">{{$toda->toda_name}}</option>
                                @endforeach
                            </select>
                            @error('user.toda_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="onSave" class="btn btn-primary text-light">Save</button>
                <button type="button" wire:click="onCancel" class="btn btn-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div wire:ignore class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Delete Driver</h6>
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