<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('departments')}}">Departments</a></li>
          <li class="breadcrumb-item active" aria-current="page">Department Detail</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Department Detail</h1>
        </div>
    </div><!--//row-->
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">General</h3>
            <div class="section-intro">General information for department.</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">
                
                <div class="app-card-body">
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="item-label"><strong>Code</strong><span class="text-danger">*</span></div>
                                @if($isedit == false)
                                <div class="item-data">{{ $department->code}}</div>
                                @else
                                <input wire:model.defer="department.code" type="text" class="form-control" required>
                                @error('department.code') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="item-label"><strong>Name</strong><span class="text-danger">*</span></div>
                                @if($isedit == false)
                                <div class="item-data">{{ $department->name}}</div>
                                @else
                                <input wire:model.defer="department.name" type="text" class="form-control" required>
                                @error('department.name') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="item-label"><strong>Description</strong></div>
                                @if($isedit == false)
                                <div class="item-data">{{ $department->description}}</div>
                                @else
                                <textarea wire:model.defer="department.description" type="text" class="form-control"></textarea>
                                @error('department.description') <span class="text-danger">{{ $message }}</span> @enderror 
                                @endif
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                </div><!--//app-card-body-->
                <div class="app-card-footer pt-4 mt-auto row justify-content-end">
                    @if(Gate::allows('allow-edit','module-departments'))
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