<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Management</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">User Management</h1>
        </div>
        <div class="col-auto">
             <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <div class="docs-search-form row gx-1 align-items-center">
                            <div class="col-auto">
                                <input id="search" type="text"  class="form-control" wire:model.debounce.100ms="search" placeholder="Search">
                            </div>
                        </div>
                    </div>
                    @if(Gate::allows('allow-create','module-user-management'))
                        <div class="col-auto">
                            <a class="btn app-btn-primary" wire:click="create" data-bs-toggle="modal" data-bs-target="#createModal" href="#">Create </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-3">
        <div class="app-card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('name')" href="#">Name <x-column-sort direction="{{ $sortdirection }}" for="name" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('email')" href="#">E-mail <x-column-sort direction="{{ $sortdirection }}" for="email" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('email_verified_at')" href="#">E-mail Verified <x-column-sort direction="{{ $sortdirection }}" for="email_verified_at" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('user_type')" href="#">User Type <x-column-sort direction="{{ $sortdirection }}" for="user_type" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('is_active')" href="#">Status <x-column-sort direction="{{ $sortdirection }}" for="is_active" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell d-lg-none"><a wire:click="sort('name')" href="#">Details <x-column-sort direction="{{ $sortdirection }}" for="name" currentsort="{{ $sortby }}"  /></a></th>
                                <th class="cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                            <tr>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $u->name }}</span></td>
                                <td class="cell d-none d-lg-table-cell"><span>{{ $u->email }}</span></td>
                                @if(is_null($u->email_verified_at))
                                    <th class="cell d-none d-lg-table-cell"><span class="badge bg-danger">Unverified</span><span class="note">NA</span></th>
                                @else
                                    <th class="cell d-none d-lg-table-cell"><span class="badge bg-success">Verified</span><span class="note">{{ date('Y/m/d H:i:s',strtotime($u->email_verified_at)) }}</span></th>
                                @endif

                                <td class="cell d-none d-lg-table-cell">{{ $u->userLevel}}</td>
                                <td class="cell d-none d-lg-table-cell">
                                    <span @class(['badge',
                                                'bg-success' => (bool)$u->is_active == true,
                                                'bg-danger' => (bool)$u->is_active == false,])>
                                        {{ (bool)$u->is_active == true ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="cell d-lg-none clickable" onclick="window.location.href = '{{ route('user-details',[$u->id]) }}'">
                                    <span class="fw-bold">Name: </span> <span>{{ $u->name }}</span><br>
                                    <span class="fw-bold">E-mail: </span> <span>{{ $u->email.(is_null($u->email_verified_at) ? ' (Unverified)':' (Verified)') }}</span><br>
                                    <span class="fw-bold">Status: </span> <span>
                                        <span @class(['text-success' => (bool)$u->is_active == true,'text-danger' => (bool)$u->is_active == false])>
                                            {{ (bool)$u->is_active == true ? 'Active' : 'Inactive' }}
                                        </span>
                                    </span>
                                </td>
                                <td class="cell text-end">
                                    <a class="btn btn-link link-primary px-1" title="View" href="{{ route('user-details',[$u->id]) }}">
                                        <i class="fa-eye fa-solid"></i>
                                    </a>
                                    @if(Gate::allows('allow-delete','module-user-management'))
                                        @if($u->user_type > 0)
                                        <a class="btn btn-link link-danger px-1" title="Delete"  href="#" wire:click="markDelete({{$u->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fa-trash fa-solid"></i>
                                        </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </select>
                </div>
                <div class="col-auto ps-0">entries</div>
            </div>

            <div class="col-auto mb-2">
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </nav><!--//app-pagination-->

    <!-- User Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create User</h1>
                    <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="settings-form">
                        <div class="mb-2">
                            <label for="name" class="form-label small">Name<span class="text-danger">*</span></label>
                            <input id="name" name="name" wire:model.defer="user.name" type="text" class="form-control form-control-sm" required>
                            @error('user.name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label small">E-mail<span class="text-danger">*</span></label>
                            <input id="email" name="email" type="email" class="form-control form-control-sm" wire:model.defer="user.email" required>
                            @error('user.email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="contactno" class="form-label small">Contact Number</label>
                            <input id="contactno" name="contactno" type="text" class="form-control form-control-sm" wire:model.defer="user.contact_number" required>
                            @error('user.contact_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label small">Password<span class="text-danger">*</span></label>
                            <input id="password" name="password" type="password" class="form-control form-control-sm" wire:model.defer="password" required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label small">Password Confirmation<span class="text-danger">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control form-control-sm" wire:model.defer="password_confirmation" required>
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="user_type" class="form-label small">User Type<span class="text-danger">*</span></label>
                            <select id="user_type" name="user_type" wire:model="user.user_type" class="form-select form-select-sm" required>
                                <option value selected>--Select User Type--</option>
                                @if(auth()->user()->user_type < 2)
                                <option value=1>Administrator</option>
                                @endif
                                <option value=2>User</option>
                            </select>
                            @error('user.user_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" wire:click="save" class="btn btn-primary">Save</button>
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
