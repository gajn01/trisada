<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('routes')}}">Routes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Routes Detail</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Routes Detail</h1>
        </div>
    </div><!--//row-->
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">General</h3>
            <div class="section-intro">General information for route.</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12">
                                <div class="item-label"><strong>Type</strong><span class="text-danger">*</span></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->type}}</div>
                                    @else
                                        <select id="type" name="type" wire:model.defer="route.type" class="form-select form-select-sm" required>
                                            <option value selected hidden>--Select Transaction--</option>
                                            <option value="Pull-out">Pull-out</option>
                                            <option value="Regular Deliveries">Regular Deliveries</option>
                                            <option value="H.O. Company Vehicles">H.O. Company Vehicles</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    @error('route.type') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Area</strong><span class="text-danger">*</span></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->area}}</div>
                                    @else
                                        <input wire:model.defer="route.area" type="text" class="form-control" required>
                                        @error('route.area') <span class="text-danger">{{ $message }}</span> @enderror 
                                    @endif
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Route Code</strong><span class="text-danger">*</span></div>

                                @if($isedit == false)
                                    <div class="item-data mb-2">{{ $route->route_code}}</div>
                                @else
                                    <input wire:model.defer="route.route_code" type="text" class="form-control" required>
                                    @error('route.route_code') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Concatenate</strong><span class="text-danger">*</span></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->concatenate}}</div>
                                    @else
                                        <input wire:model.defer="route.concatenate" type="text" class="form-control" required>
                                        @error('route.concatenate') <span class="text-danger">{{ $message }}</span> @enderror 
                                    @endif
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Scheme</strong><span class="text-danger">*</span></div>

                                @if($isedit == false)
                                    <div class="item-data mb-2">{{ $route->scheme}}</div>
                                @else
                                    <input wire:model.defer="route.scheme" type="text" class="form-control" required>
                                    @error('route.scheme') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>KM Travelled</strong><span class="text-danger">*</span></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->km_travelled}}</div>
                                    @else
                                        <input wire:model.defer="route.km_travelled" type="text" class="form-control" required>
                                        @error('route.km_travelled') <span class="text-danger">{{ $message }}</span> @enderror 
                                    @endif
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Liters</strong><span class="text-danger">*</span></div>

                                @if($isedit == false)
                                    <div class="item-data mb-2">{{ $route->liters}}</div>
                                @else
                                    <input wire:model.defer="route.liters" type="text" class="form-control" required>
                                    @error('route.liters') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Fuel</strong><span class="text-danger">*</span></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->fuel}}</div>
                                    @else
                                        <input wire:model.defer="route.fuel" type="text" class="form-control" required>
                                        @error('route.fuel') <span class="text-danger">{{ $message }}</span> @enderror 
                                    @endif
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Fuel Cash Request</strong></div>

                                @if($isedit == false)
                                    <div class="item-data mb-2">{{ $route->fuel_cash_request}}</div>
                                @else
                                    <input wire:model.defer="route.fuel_cash_request" type="text" class="form-control" >
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>P.O.</strong></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->p_o}}</div>
                                    @else
                                        <input wire:model.defer="route.p_o" type="text" class="form-control" >
                                    @endif
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Salary</strong></div>

                                @if($isedit == false)
                                    <div class="item-data mb-2">{{ $route->salary}}</div>
                                @else
                                    <input wire:model.defer="route.salary" type="text" class="form-control" >
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Food Allowance</strong></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->food_allowance}}</div>
                                    @else
                                        <input wire:model.defer="route.food_allowance" type="text" class="form-control" >
                                    @endif
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Parking</strong></div>

                                @if($isedit == false)
                                    <div class="item-data mb-2">{{ $route->parking}}</div>
                                @else
                                    <input wire:model.defer="route.parking" type="text" class="form-control" >
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Easytrip</strong></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->easytrip}}</div>
                                    @else
                                        <input wire:model.defer="route.easytrip" type="text" class="form-control" >
                                    @endif
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Autosweep</strong></div>
                                @if($isedit == false)
                                    <div class="item-data mb-2">{{ $route->autosweep}}</div>
                                @else
                                    <input wire:model.defer="route.autosweep" type="text" class="form-control" >
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="item-label"><strong>Toll Fee</strong></div>
                                    @if($isedit == false)
                                        <div class="item-data mb-2">{{ $route->toll_fee}}</div>
                                    @else
                                        <input wire:model.defer="route.toll_fee" type="text" class="form-control" >
                                    @endif
                            </div>
                        </div>
                    </div>
                </div><!--//app-card-body-->
                <div class="app-card-footer pt-4 mt-auto row justify-content-end">
                    @if(Gate::allows('allow-edit','route'))
                    <div class="col-auto">
                        @if($isedit == true)
                        <a wire:click="save" class="btn btn-sm btn-primary" >Save Changes</a>
                        <a wire:click="cancel" class="btn btn-sm btn-secondary" >Cancel</a>  
                        @else
                        <a wire:click="edit" class="btn btn-sm app-btn-primary" >Edit Detail</a>
                        @endif
                    </div>
                    @endif
                </div><!--//app-card-footer-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->
    <hr class="my-4">
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