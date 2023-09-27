<div>
    <div class="row vh-100">
        <div wire:ignore.self
            class="vh-100 col-auto report-sidepanel col-lg-2 offcanvas-lg offcanvas-start d-print-none shadow"
            tabindex="-1" id="offcanvasParameters" aria-labelledby="offcanvasParametersLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Report Parameters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasParameters"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column report-sidepanel-inner">
                <div class="row">
                    <div class="col-12 my-2 d-none d-lg-block">
                        <h5>Report Parameters</h5>
                        <hr>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="start_date"> Start Date</label>
                        <input name="start_date" type="date" wire:model.debounce.1s="start_date"
                            class="form-control form-control-sm" max="" required>
                    </div><!--//col-->
                    <div class="col-12 mb-2">
                        <label for="end_date"> End Date</label>
                        <input name="end_date" type="date" wire:model.debounce.1s="end_date"
                            class="form-control form-control-sm" max="" required>
                    </div><!--//col-->
                </div><!--//col-->

                <div class="d-flex justify-content-end">
                    {{-- <button class="btn btn-primary me-2" type="button" title="Export to CSV"
                        wire:click="exportToCSV"><i class="fa fa-solid fa-file-csv"></i> Export</button> --}}
                    <button class="btn btn-primary" type="button" title="Print" onclick="print_view()"><i
                            class="fa fa-solid fa-print"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="col-12 offset-lg-2 col-lg-10 vh-100">
            <div class="d-flex flex-column justify-content-center">
                <div class="col-auto d-lg-none d-print-none">
                    <div class="docs-search-form row gx-1 align-items-center mt-2">
                        <div class="col-auto">
                            <a class="btn btn-sm link-primary" title="Report Parameters" data-bs-toggle="offcanvas"
                                href="#offcanvasParameters" role="button" aria-controls="offcanvasFilter">
                                <i class="fa-xl fa-solid fa-tasks"></i> <span>Toggle Report Parameters</span>
                            </a>
                        </div>
                    </div>
                </div><!--//col-->
                <table class="">
                    <thead>
                        <tr>
                            <th colspan="4">
                                <div class="d-flex justify-content-center">
                                    <div class="p-0">
                                        <img class="d-inline-block img-responsive" src="" width="45">
                                        <span class="fw-bold fs-5 text-middle h-100">BLUEMANTLE INDUSTRIES,
                                            INC.</span>
                                        <h5 class="text-center fw-bold">Booking Summary</h5>
                                        <h5 class="text-center fw-bold"></h5>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Report Date: <span class="fw-bold">{{ date('M j, Y g:i:s a', strtotime(now())) }}</span>
                            </td>
                            <td class="text-end">
                                Generated By: <span class="fw-bold">{{ auth()->user()->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Coverage: <span class="fw-bold">
                                    {{ $start_date . ' - ' . $end_date }}
                                </span>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <div class="d-flex flex-row justify-content-between small pt-3">
                                    <div class="d-flex gap-3 mb-3">
                                        <div class="col-auto">Display</div>
                                        <div class="col-auto">
                                            <select wire:model="displaypage" class="form-select form-select-sm w-auto ">
                                                <option value="100000">All</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="col-auto ps-0">entries</div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-dark mb-0 text-left small">
                                        <thead>
                                            <tr>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Booking Number</p>
                                                        <a class="d-print-none" href="#" wire:click="sort('id')">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Transaction Type</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Date Requested</p>
                                                        <a class="d-print-none" href="#"
                                                            wire:click="sort('date_created')">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Requestor</p>
                                                        <a class="d-print-none" href="#" wire:click="sort('')">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Department</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Origin</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Destination</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Date Required</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Time Required</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Return Date</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Purpose</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Plate Number</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Driver</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                                <th class="cell text-start" style="width: 6em">
                                                    <span class="d-flex align-items-center gap-2">
                                                        <p class="m-0">Booking Status</p>
                                                        <a class="d-print-none" href="#">
                                                            <x-column-sort direction="" for="monthsleft"
                                                                currentsort="" />
                                                        </a>
                                                    </span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($reservation_data as $item)
                                                <tr>
                                                    <th><span>#{{ $item->id }}</span></th>
                                                    <td><span>
                                                            @if (!isset($item->trip_ticket->transaction_type) || $item->trip_ticket->transaction_type == 2)
                                                                {{ 'H.O' }}
                                                            @else
                                                                {{ 'Others' }}
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td><span>{{ date('m-d-Y', strtotime($item->date_created)) }}</span>
                                                    </td>
                                                    <td><span>{{ $item->created_by->name }}</span></td>
                                                    <td><span>{{ $item->department->name }}</span></td>
                                                    <td><span>{{ $item->pickup_location }}</span></td>
                                                    <td><span>
                                                            @if ($item->destination == 0)
                                                                @foreach ($item->destinations as $s)
                                                                    {{ $s->destination }}
                                                                    @if (!$loop->last)
                                                                        <br>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                {{ $item->destination }}
                                                            @endif
                                                        </span></td>
                                                    <td><span>{{ date('m-d-Y', strtotime($item->pickup_date)) }}</span>
                                                    </td>
                                                    <td><span>{{ date('h:i A', strtotime($item->pickup_date)) }}</span>
                                                    </td>
                                                    <td><span>{{ date('m-d-Y h:i A', strtotime($item->return_date)) }}</span>
                                                    </td>
                                                    <td><span>{{ $item->purpose }}</span></td>
                                                    <td><span>{{ $item->vehicle->plate_number ?? 'N/A' }}</span></td>
                                                    <td><span>{{ $item->company_driver->name ?? 'N/A' }}</span>
                                                    </td>
                                                    <td><span>{{ $item->statusString }}</span></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="14">No Data Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <nav class="d-print-none mt-4">
                    <div class="row justify-content-end">
                        <div class="col-auto mb-2">
                            {{ $reservation_data->onEachSide(1)->links() }}
                        </div>
                    </div>
                </nav><!--//app-pagination-->
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script src="{{ asset('js/print.js') }}"></script>
    @endpush
</div>
