<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('trip-categories')}}">Trip Categories</a></li>
          <li class="breadcrumb-item active" aria-current="page">Trip Category Detail</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Trip Category Detail</h1>
        </div>
    </div><!--//row-->
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">General</h3>
            <div class="section-intro">General information for trip category.</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">
                
                <div class="app-card-body">
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="item-label"><strong>Description</strong><span class="text-danger">*</span></div>
                                @if($isedit == false)
                                <div class="item-data">{{ $tripcategory->description}}</div>
                                @else
                                <input wire:model.defer="tripcategory.description" type="text" class="form-control" required>
                                @error('tripcategory.description') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="item-label"><strong>Priority Level</strong><span class="text-danger">*</span></div>
                                @if($isedit == false)
                                <div class="item-data">{{ $tripcategory->priority_level_string }}</div>
                                @else
                                <select id="priority_level" name="priority_level" wire:model="tripcategory.priority_level" class="form-select form-select-sm" required>
                                    <option value selected hidden>--Select Priority Level--</option>
                                    <option value=0>Low</option>
                                    <option value=1>Moderate</option>
                                    <option value=2>High</option>
                                </select>
                                @error('tripcategory.priority_level') <span class="text-danger">{{ $message }}</span> @enderror
                                @endif
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                </div><!--//app-card-body-->
                <div class="app-card-footer pt-4 mt-auto row justify-content-end">
                    @if(Gate::allows('allow-edit','module-trip-categories'))
                    <div class="col-auto">
                        @if($isedit == true)
                        <a wire:click="save" class="btn btn-sm btn-primary" href="#">Save Changes</a>
                        <a wire:click="cancel" class="btn btn-sm btn-secondary" href="#">Cancel</a>  
                        @else
                        <a wire:click="edit" class="btn btn-sm app-btn-primary" href="#">Edit Detail</a>
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