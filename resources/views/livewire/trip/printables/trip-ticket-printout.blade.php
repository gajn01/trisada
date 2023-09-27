<div>
    <div class="d-flex d-print-none my-2 justify-content-center">
        <button class="btn btn-primary" type="button" title="print" onclick="print_view()"><i class="fa fa-solid fa-print"></i> Print Trip Ticket</button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col">
            <table class="table table-bordered border-dark page-break-after">
                <thead>
                    
                    <tr>
                        <td colspan="4">
                            {{-- <div class="d-flex justify-content-between">
                            <span class="p-2 fw-bold bg-gray"></span>
                            <span class="p-2 fw-bold bg-gray">TIN: <span class="text-danger">216-682-854</span></span>
                            </div> --}}
                            <div class="d-flex flex-column justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="p-0">
                                        <img class="d-inline-block img-responsive" src="{{ asset('img/bm-logo.png')}}" width="45">
                                        <span class="fw-bold fs-5 text-middle h-100">BLUEMANTLE INDUSTRIES, INC.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 row text-black small pt-2 pb-3">
                                <div class="col-12 fw-bold text-center fs-5 mb-2">TRIP TICKET</div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">TRIP TICKET ID: </div>
                                        <div class="col-6 fw-semibold">{{  str_pad($ticket->id, 10, '0', STR_PAD_LEFT)  }}</div>
                                    </div>
                                </div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">TRIP TICKET DATE: </div>
                                        <div class="col-6 fw-semibold">{{ date('Y-m-d h:i a',strtotime($ticket->date_created))}}</div>
                                    </div>
                                </div>
                                <br>
                            </div>
                           {{--  <div class="p-2  text-black fw-bold">
                                <div class="px-5 text-start">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-semibold">Trip Ticket #: <span class="text-black">{{ str_pad($ticket->id, 10, '0', STR_PAD_LEFT) }}</span></span>
                                        </div>
                                        <div class="col">
                                            <span class="fw-semibold">Ticket Date: <span class="text-black"> {{ date('Y-m-d h:i a',strtotime($ticket->date_created))}}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>  --}}
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">
                            <div class="p-2 row text-black small pt-2 pb-3">
                                <div class="col-12 fw-bold text-center fs-6 mb-2">BOOKING DETAILS</div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">Booking ID: </div>
                                        <div class="col-6 fw-semibold">{{ str_pad($ticket->reservation->id, 10, '0', STR_PAD_LEFT) }}</div>
                                        <div class="col-6">REQUESTED BY: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->created_by->name  }}</div>
                                    </div>
                                </div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">PASSENGER COUNT: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->head_count  }}</div>
                                        <div class="col-6">DEPARTMENT: </div>
                                        <div class="col-6 fw-semibold">{{ $ticket->reservation->department->name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-3">PURPOSE: </div>
                                        <div class="col-9 fw-semibold">{{  $ticket->reservation->purpose }}</div>
                                        <div class="col-3">SPECIAL INSTRUCTION: </div>
                                        <div class="col-9 fw-semibold">{{  $ticket->reservation->special_instruction  }}</div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="p-2 row text-black small pt-2 pb-3">
                                <div class="col-12 fw-bold text-center fs-6 mb-2">VEHICLE & DRIVER DETAILS</div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">MAKE/MODEL: </div>
                                        <div class="col-6 fw-semibold">{{ $ticket->reservation->vehicle->VehicleName  }}</div>
                                        <div class="col-6">PLATE NO: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->vehicle->plate_number }}</div>
                                        <div class="col-6">TYPE: </div>
                                        <div class="col-6 fw-semibold">{{ $ticket->reservation->vehicle->vehicle_type->name}}</div>
                                        <div class="col-6">DRIVER`S NAME: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->own_driver_name->name }}</div>
                                    </div>
                                </div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">FUEL CAPACITY: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->vehicle->fuel_capacity }} LITERS</div>
                                        <div class="col-6">FUEL TYPE: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->vehicle->fuel_type }}</div>
                                        <div class="col-6">CHASSIS NO: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->vehicle->chassis_number }}</div>
                                        <div class="col-6">DRIVER`S DEPT.: </div>
                                        <div class="col-6 fw-semibold">{{  $ticket->reservation->own_driver_name->department->name ?? 'Logistic' }}</div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="p-2 row text-black small pt-2 pb-3">
                                <div class="col-12 fw-bold text-center fs-6 mb-2">ROUTES DETAILS</div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">PICK-UP DATE: </div>
                                        <div class="col-6 fw-semibold">{{ date('Y-m-d h:i a', strtotime($ticket->reservation->pickup_date)) }}</div>
                                        <div class="col-6">ARRIVAL DATE: </div>
                                        <div class="col-6 fw-semibold">{{ date('Y-m-d h:i a', strtotime($ticket->reservation->return_date)) }}</div>
                                    </div>
                                </div>
                                <div class="col-6 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-6">ORIGN: </div>
                                        <div class="col-6 fw-semibold">{{ $ticket->reservation->pickup_location  }}</div>
                                        <div class="col-6">TRIP DISTANCE: </div>
                                        <div class="col-6 fw-semibold">{{ $ticket->reservation->trip_distance }} Km</div>
                                    </div>
                                </div>
                                <div class="col-12 h-100 px-3">
                                    <div class="row h-100 text-start">
                                        <div class="col-12">DESTINATION:   
                                            <span class="fw-semibold">
                                                @forelse ($destination_list as $destination)
                                                    <span class="fw-semibold"> Trip {{ $destination->order }}</span>
                                                    <span class="fw-bold">{{$destination->destination}} </span>
                                                @if (!$loop->last)
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                                            <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                                                        </svg>
                                                    @endif
                                                @empty
                                                    {{  $ticket->reservation->destination }}
                                                @endforelse
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            
                                <br>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="col-12 fw-bold text-center fs-6 mb-2">TARIFF DETAILS</div>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th  class="p-0"></th>
                                            <th  class="p-0"></th>
                                            <th  class="p-0 text-end pe-5 pb-2">Released(₱)</th>
                                            <th  class="p-0 text-end pe-5 pb-2">Non-Released(₱)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tarifCost as $index => $item)
                                            <tr>
                                                <td class="py-0  ">{{ $index + 1 }}</td>
                                                <td class="p-0"><span class="fw-semibold">{{ $item['tarif_description'] }}</span></td>
                                                <td class="p-0 text-end pe-5">
                                                    <span class="fw-semibold">{{ number_format($item->release_amount, 2) }}</span>
                                                </td>
                                                <td class="p-0 text-end pe-5">
                                                    <span class="fw-semibold">{{ number_format($item->unrelease_amount, 2) }}</span>
                                                </td>
                                        @endforeach
                                        <tr class="border-top border-dark">
                                            <td class="p-0 "></td>
                                            <td class="p-0 "><span class="fw-bold">Total </span></td>
                                            <td class="p-0 text-end pe-5">
                                                <span class="fw-bold">{{number_format($releasedTotal, 2) }}</span>
                                            </td>
                                            <td class="p-0 text-end pe-5">
                                                <span class="fw-bold">{{number_format($unreleasedTotal, 2) }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
        
                                </table>
                            </div>
                        </td>
                    </tr>
                 {{--    <tr>
                        <td colspan="4">
                            <div class="d-flex flex-column text-center small">
                                <span class="text-start text-black fw-bold mb-2">Purpose:</span>
                                <span class="text-start" style="white-space: pre">{{$ticket->reservation->purpose}}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="d-flex flex-column text-center small">
                                <span class="text-start text-black fw-bold mb-2">Special Instructions:</span>
                                <span class="text-start" style="white-space: pre">{{$ticket->reservation->special_instruction}}</span>
                            </div>
                        </td>
                    </tr> --}}
                    <tr>
                        <td colspan="4">
                            <div class="d-flex flex-row  text-center text-black fw-bold small pt-3 pb-3">
                                <div class="col px-3">
                                    <div class="row">
                                        <div class="col-4">Released By:</div>
                                        <div class="col-8 d-flex flex-column">
                                            <div class="border-bottom border-dark">{{$ticket->released_by->name}}</div>
                                            <span class="small text-center"> Logister Officer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col h- px-3">
                                    <div class="row">
                                        <div class="col-4">Received By:</div>
                                        <div class="col-8 d-flex flex-column">
                                            <div class="border-bottom border-dark">{{$ticket->received_by}}</div>
                                            <span class="small text-center">Driver`s Name</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex d-print-none my-2 justify-content-center">
        <button class="btn btn-primary" type="button" title="print" onclick="print_view()"><i class="fa fa-solid fa-print"></i> Print Trip Ticket</button>
    </div>
    @push('custom-scripts')
    <script src="{{ asset('js/print.js')}}"></script>
    <script type="text/javascript">
         window.onload = function() { window.print(); }
    </script>
    @endpush
</div>
