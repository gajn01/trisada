<div>
    <nav aria-label="breadcrumb">
        <div>
            <nav aria-label="breadcrumb" class="">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('driver-list') }}">Driver Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Driver Detail</li>
                </ol>
            </nav>
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Driver Detail</h1>
                </div>
                <div class="col-auto">
                    @if ($isedit == true)
                        <button name="save_changes" wire:click="save"
                            class="btn btn-sm btn-primary">Save Changes</button>
                        <button name="cancel_changes" wire:click="onUpdateOrCancel"
                            class="btn btn-sm btn-secondary">Cancel</button>
                    @else
                        <button name="edit_changes" wire:click="onUpdateOrCancel"
                            class="btn btn-sm app-btn-primary">Edit Detail</button>
                    @endif
                </div>
            </div><!--//row-->

            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">General</h3>
                    <div class="section-intro">Personal information.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>First Name</strong> </div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->firstname ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="user.firstname" type="text" class="form-control" required>
                                            @error('user.firstname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>Middle Name</strong></div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->midname ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="user.midname" type="text" class="form-control" required>
                                            @error('user.midname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>Last Name</strong></div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->lastname ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="user.lastname" type="text" class="form-control" required>
                                            @error('user.lastname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="item-label"><strong>Birthday</strong> </div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->birthday ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="user.birthday" type="date" class="form-control" required>
                                            @error('user.birthday')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="item-label"><strong>Age</strong></div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->age ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="user.age" type="number" class="form-control" required>
                                            @error('user.age')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="item-label"><strong>Contact No.</strong> </div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->contact_no ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="user.contact_no" type="number" class="form-control" required>
                                            @error('user.contact_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="item-label"><strong>Email Address</strong></div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->email ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="user.email" type="text" class="form-control" required>
                                            @error('user.email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-12">
                                        <div class="item-label"><strong>Home Address.</strong> </div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->user->address ?? 'n/a' }}</div>
                                        @else
                                            <textarea id="user.address" name="user.address" wire:model.defer="user.address" class="form-control form-control-sm"
                                            rows="3"></textarea>
                                            @error('user.address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                
                                </div>
                            </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->
            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Driver </h3>
                    <div class="section-intro">Driver information.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>Driver License</strong> </div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->driver_license }}</div>
                                        @else
                                            <input wire:model.defer="driver.driver_license" type="text" class="form-control" required>
                                            @error('driver.driver_license')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>Plate Number</strong></div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->plate_number ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="driver.plate_number" type="text" class="form-control" required>
                                            @error('driver.plate_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>Franchise Number</strong></div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->franchise_no ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="driver.franchise_no" type="text" class="form-control" required>
                                            @error('driver.franchise_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>Register Number</strong> </div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->register_number ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="driver.register_number" type="text" class="form-control" required>
                                            @error('driver.register_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>OR/CR</strong></div>
                                        @if ($isedit == false)
                                            <div class="item-data">{{ $driver->or_cr ?? 'n/a' }}</div>
                                        @else
                                            <input wire:model.defer="driver.or_cr" type="text" class="form-control" required>
                                            @error('driver.or_cr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="item-label"><strong>Toda</strong></div>
                                        <div class="item-data">{{ $driver->toda->toda_name ?? 'n/a' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto mb-2"><strong>Status:</strong>
                                </div>
                                <div class="col-auto form-check form-switch ml-5 ">
                                    {{-- @if (Gate::allows('access-enabled', 'module-set-status'))
                                        @if ($sameUser == false || $user->user_type > 0)
                                            <input class="form-check-input" type="checkbox" wire:model="isactive"
                                                id="isactive" checked>
                                        @endif
                                    @endif --}}
                                    <label class="form-check-label" for="isactive">
                                        {{--   @if ((bool) $user->is_active == true)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif --}}
                                    </label>
                                </div>
                            </div>

                            {{--      <div class="mb-2"><strong>Date Created:</strong>
                                {{ date('F d, Y h:i A', strtotime($user->date_created)) }}</div>
                            <div class="mb-2"><strong>Date Last Updated:</strong>
                                {{ date('F d, Y h:i A', strtotime($user->date_updated)) }}</div>
                            <div class="mb-2"><strong>Email Verified:</strong>
                                @if (is_null($user->email_verified_at))
                                    <span class="badge bg-danger"> Unverified</span>
                                    @if (Gate::allows('access-enabled', 'module-override-email-verification'))
                                        <a class="link-primary" data-bs-toggle="modal" data-bs-target="#confirmOverride"
                                            href="#"><small class="p-1">Override Verification</small></a>
                                    @endif
                                @else
                                    <span class="badge bg-success">Verified</span>
                                @endif --}}
                        </div>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        {{--     @if ($user->user_type > 1 && $user->user_type < 3)
                <hr class="my-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">Access Scope</h3>
                        <div class="section-intro">Settings for user access scope.</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card shadow-sm p-4">
                            <div class="app-card-body">
                                <div class="">
                                    <div class="row mb-5">
                                        @if (Gate::allows('access-enabled', 'module-set-access-scope'))
                                            <div class="col-6 col-md-4">
                                                <select class="form-select form-select-sm"
                                                    wire:model="selectedDepartment">
                                                    <option>--Select Department--</option>
                                                    @foreach ($departments as $d)
                                                        <option value={{ $d->id }}>{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('selectedDepartment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6 col-md-4 mb-3">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    wire:click="addDepartment"><small>Add</small></button>
                                            </div>
                                        @endif
                                        <div class="col-10 offset-1">
                                            <h6>Department</h6>
                                            <ol class="list-group list-group-numbered">
                                                @forelse($user->departments as $dep)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">{{ $dep->code }}</div>
                                                            {{ $dep->name }}
                                                        </div>
                                                        @if (Gate::allows('access-enabled', 'module-set-access-scope'))
                                                            <a class="btn btn-sm btn-link link-danger" title="Remove"
                                                                wire:click="removeDepartment({{ $dep->id }})">
                                                                <i class="fa-lg fa-solid fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </li>
                                                @empty
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold text-danger">Empty</div>
                                                        </div>
                                                    </li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                @if (Gate::allows('access-enabled', 'module-set-module-access'))
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Module Access</h3>
                            <div class="section-intro">Settings to enable or disable access to specified modules.</div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <form class="settings-form">
                                        @php
                                            $count = 0;
                                            $last_parent = 'n/a';
                                            $last_parent_enabled = false;
                                        @endphp
                                        <ul class="list-group">
                                            @foreach ($moduleList as $module)
                                                @php
                                                    
                                                    if (is_null($module['parent']) == true) {
                                                        $last_parent = $module['module'];
                                                        $last_parent_enabled = $useraccess[$count]['enabled'];
                                                    }
                                                @endphp

                                                @if (is_null($module['parent']) || (!is_null($module['parent']) && $last_parent_enabled == true))
                                                    <li
                                                        class="border-0 list-group-item d-flex justify-content-between align-items-center py-0">

                                                        <div @class([
                                                            'col-7 col-lg-5' => is_null($module['parent']),
                                                            'col-6 col-lg-4 offset-1' => !is_null($module['parent']),
                                                        ])>
                                                            <div class="form-check form-switch mb-3">
                                                                @if (!(($module['module'] == 'module-user-management' || $module['parent'] == 'module-user-management') && auth()->user()->user_type > 1))
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="{{ $module['module'] }}"
                                                                        wire:model="useraccess.{{ $count }}.enabled">
                                                                @endif
                                                                <label @class([
                                                                    'form-check-label',
                                                                    'fw-semibold' => is_null($module['parent']),
                                                                ])
                                                                    for="{{ $module['module'] }}">{{ $module['module_name'] }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-5 col-lg-4">
                                                            @if (!($module['module'] == 'module-user-management' && auth()->user()->user_type > 1))
                                                                @if ($module['access_type'] == 1)
                                                                    <select class="form-select form-select-sm"
                                                                        wire:model="useraccess.{{ $count }}.access_level"
                                                                        style="max-width:12em"
                                                                        @if ($useraccess[$count]['enabled'] == false) disabled @endif>
                                                                        <option value=0>View</option>
                                                                        <option value=1>Create</option>
                                                                        <option value=2>Create + Update</option>
                                                                        <option value=3>Full Access</option>
                                                                    </select>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="d-none d-lg-block small col-12 col-lg-3">
                                                            {{ $module['description'] }}
                                                        </div>
                                                    </li>
                                                @endif
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
                                        </ul>
                                        <div class="mt-3">
                                        </div>
                                    </form>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <hr class="my-4">
                @endif
            @endif --}}

        <!-- Modal -->
        <div wire:ignore class="modal fade" id="confirmOverride" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="confirmOverrideLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Override E-mail Verification</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to override e-mail verification process for this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary text-light" wire:click="overrideEmailVerification"
                            data-bs-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div wire:ignore class="modal fade" id="confirmResetPasswordModal" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmResetPasswordLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Reset Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to reset user password to "Password123"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary text-light" wire:click="resetPassword"
                            data-bs-dismiss="modal">Yes</button>
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
                window.livewire.on('show-toast', event => {
                    var toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('alertToast'));
                    toast.show();
                });
            </script>
        @endpush
</div>
