<div wire:poll.300s class="col">
    <div class="app-card  app-card-orders-table h-100 shadow-sm " >
        <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h4 class="app-card-title text-marygrace">Daily Updates ({{ date('M d, Y')}})</h4>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//app-card-header-->
        <div class="app-card-body px-3 lg-4" >
            <div class="overflow-auto" style="max-height: 35em">
            <h6 class="my-3 small">Vehicle Activities</h6>
                <ul class="cta-color small">
                    @forelse ($reservations as $r)
                        <li>
                            <span class="text-dark fw-semibold">Vehicle: </span>{{ $r->vehicle->make.' '.$r->vehicle->model }}<br>
                            <span class="text-dark fw-semibold">Plate No: </span>{{ $r->vehicle->plate_number}}<br>
                            <span class="text-dark fw-semibold">Driver: </span>{{ $r->own_driver == true ? $r->own_driver_name->name ?? '(not yet assigned)' : ($r->status == 1 ? $r->company_driver->name : '(not yet assigned)') }}<br>
                            <span class="text-dark fw-semibold">Department: </span>{{ $r->department->name}}<br>
                            <span class="text-dark fw-semibold">Destination:
                                @if ($r->destination != 0)
                                    <span >{{ $r->destination }}</span><br>
                                @else
                                    @foreach ($r->destination_list as $destination)
                                        <span> Trip {{ $destination->order }}.</span>
                                        <span >{!! $destination->destination !!} </span><br>
                                        @if (!$loop->last)
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
                                        @endif
                                    @endforeach
                                @endif
                            <span class="text-dark fw-semibold">Departure: </span>{{ date('Y-m-d H:i a',strtotime($r->pickup_date)) }}<br>
                            <span class="text-dark fw-semibold">ETA: </span>{{ date('Y-m-d H:i a',strtotime($r->return_date)) }}<br>
                        </li>
                    @empty
                        <li>
                            <span class="cta-color fw-semibold">No Activity<br>
                        </li>
                    @endforelse
                </ul>
            <hr>
            <h6 class="my-3 small">Available Vehicles</h6>
                <ul class="cta-color small">
                    @forelse ($vehicles as $v)
                        <li>{{ $v->make.' '.$v->model.' ('.$v->plate_number.')' }}</li>
                    @empty
                        <li><span class="cta-color fw-semibold">No Vehicle Available<br></li>
                    @endforelse
                </ul>
            </div>
        </div><!--//app-card-body-->
         <div class="app-card-footer">
            <div class="text-center small p-1">
                <small>Last Updated: {{ date('g:i a', strtotime(now()))}}</small>
            </div>
        </div>
    </div><!--//app-card-->
</div><!--//col-->

