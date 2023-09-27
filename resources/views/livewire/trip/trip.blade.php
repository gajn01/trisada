<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Maintenance</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0 ">Trip Management</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <a class="icon"  data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter"  data-bs-toggle="tooltip" data-bs-placement="top" title="Filter" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/></svg>
                        </a>
                    </div> 
                    <div class="col-auto">
                        <div class="docs-search-form row gx-1 align-items-center">
                            <div class="col-auto">
                                <input id="search" type="text" wire:model="search"
                                    class="form-control search-docs" placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion" id="accordionFilter" wire:ignore>
        <div class="accordion-item secondary-bg border-0">
          <div id="collapseFilter" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionFilter">
            <div class="accordion-body">
              <div class="page-utilities">
                  <div class="row g-2 justify-content-start justify-content-md-start align-items-center">
                    <div class="col-auto d-flex flex-column">
                        <label for="transaction_type" class="form-label">Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-select form-select-md ms-auto d-inline-flex w-auto" wire:model="transaction_filter">
                            <option value hidden selected>--Select Status--</option>
                            <option value="all">All</option>
                            <option value="0">Pull-out</option>
                            <option value="1">Regular Deliveries</option>
                            <option value="2">H.O. Company Vehicles</option>
                            <option value="3">Others</option>
                        </select>
                    </div>
                      <div class="col-auto d-flex flex-column">
                          <label for="status" class="form-label">Status</label>
                          <select name="status" id="status" class="form-select form-select-md ms-auto d-inline-flex w-auto" wire:model="status_filter">
                              <option value hidden selected>--Select Status--</option>
                              <option value="all">All</option>
                              <option value="0">For Release</option>
                              <option value="1">Released</option>
                              <option value="2">Closed</option>
                          </select>
                      </div>
                      <div class="col-auto  d-flex flex-column">
                          <label for="department" class="form-label">Department</label>
                          <select name="department" id="department" class="form-select form-select-md ms-auto d-inline-flex w-auto" wire:model="department_filter">
                              <option value hidden selected>--Select Department--</option>
                              <option value="all">All</option>
                              @foreach ($department as $item)
                                  <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-auto d-flex flex-column">
                          <label for="trip_ticket_date" class="form-label">Trip Ticket Date</label>
                          <input type="date" class="form-control" name="trip_ticket_date" id="trip_ticket_date" wire:model="ticket_date">
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('id')" href="#">Trip ID <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}" />
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('id')" href="#">Transaction Type <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}" />
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('id')" href="#">Department <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}" />
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('id')" href="#">Requested By <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}" />
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('id')" href="#">Trip Ticket Date <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}" />
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('id')" href="#">Destination <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}" />
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('id')" href="#">Status <x-column-sort direction="{{ $sortdirection }}" for="id" currentsort="{{ $sortby }}" />
                            <th scope="col" class="text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trip_ticket_list as $trip_ticket)
                            <tr>
                                <td class="cell d-none d-lg-table-cell">{{ $trip_ticket->id  }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ $trip_ticket->Transactions }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ $trip_ticket->reservation->department->name }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ $trip_ticket->reservation->created_by->name }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ date('F d, Y',strtotime($trip_ticket->ticket_date)) }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ $trip_ticket->reservation->destination != 0 ? $trip_ticket->reservation->destination : 'Multiple Trips'  }}</td>

                                <td class="cell d-none d-lg-table-cell"> <span class="badge {{ $trip_ticket->StatusBadge }}"> {{ $trip_ticket->StatusString }} </span> </td>
                                <td class="cell d-none d-lg-table-cell">
                                    <a class="btn btn-sm btn-link link-primary" title="View"
                                        href="{{ route('trip-details', [$trip_ticket->id]) }}">
                                        <i class="fa-lg fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td class="cell d-lg-none clickable" onclick="window.location.href = '{{ route('trip-details',[$trip_ticket->id]) }}'">
                                    <span class="fw-bold">Trip ID: </span> <span>{{ $trip_ticket->id  }}</span><br>
                                    <span class="fw-bold">Department: </span> <span>{{ $trip_ticket->reservation->department->name }}</span><br>
                                    <span class="fw-bold">Requested By: </span> <span>{{ $trip_ticket->reservation->created_by->name  }}</span><br>
                                    <span class="fw-bold">Pick-up Date & Time : </span> <span>{{ date('F d, Y h:i a',strtotime($trip_ticket->reservation->pickup_date)) }}</span><br>
                                    <span class="fw-bold">Return Date & Time : </span> <span>{{ date('F d, Y h:i a',strtotime($trip_ticket->reservation->return_date)) }}</span><br>
                                    <span class="fw-bold">Destination: </span> <span>{{ $trip_ticket->reservation->destination != 0 ? $trip_ticket->reservation->destination : 'Multiple Trips'  }}</span><br>
                                    <span class="fw-bold">Status: </span>  <span class="badge {{ $trip_ticket->StatusBadge }}"> {{ $trip_ticket->StatusString }} </span><br>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="7">NO DATA</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <!--//table-responsive-->
        </div>
        <!--//app-card-body-->
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="page-utilities d-flex justify-start">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <label for="displaypage">Display</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select-sm w-auto" id="displaypage" wire:model="displaypage">
                            <option selected value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                        <label for="">entries</label>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//table-utilities-->
        </div>
        <div class="col-sm-12 col-md-6">
            <nav class="app-pagination">
                {{ $trip_ticket_list->onEachSide(0)->links() }}
            </nav>
            <!--//app-pagination-->
        </div>
    </div>
</div>
