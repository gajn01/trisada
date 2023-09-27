<div>
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reservation List</li>
        </ol>
    </nav>
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Reservation List</h1>
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
                                <input id="search" type="text" wire:model.defer="search" class="form-control search-docs" placeholder="Search">
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
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select form-select-md ms-auto d-inline-flex w-auto" wire:model="status_filter">
                            <option value hidden selected>--Select Status--</option>
                            <option value="all">All</option>
                            {{-- <option value="0">Pre-Reserve</option> --}}
                            <option value="1">Pending</option>
                            <option value="2">Booked</option>
                            <option value="3">Declined</option>
                            <option value="4">Cancelled</option>
                            <option value="5">Approved</option>
                        </select>
                    </div>
                    @if (auth()->user()->user_type <= 1 ||  Gate::allows('access-enabled','module-reservation-approval') == true  )

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
                            @endif
                    <div class="col-auto d-flex flex-column">
                        <label for="pickup_date" class="form-label">Pick-up Date</label>
                        <input type="date" class="form-control" name="pickup_date" id="pickup_date" wire:model="date_pickup_filter">
                    </div>
                    <div class="col-auto d-flex flex-column">
                        <label for="returned_date" class="form-label">Returned Date</label>
                        <input type="date" class="form-control" name="returned_date" id="returned_date" wire:model="date_returned_filter">
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
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('reservations.id')" href="#">Booking Number <x-column-sort direction="{{ $sortdirection }}" for="reservations.id" currentsort="{{ $sortby }}"  /></a></th>
                            @if (auth()->user()->user_type <= 1  && Gate::allows('access-enabled','module-reservation-approval') == true )
                                <th class="cell d-none d-lg-table-cell"><a wire:click="sort('reservations.department_id')" href="#">Department <x-column-sort direction="{{ $sortdirection }}" for="reservations.department_id" currentsort="{{ $sortby }}"  /></a></th>
                            @endif
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('reservations.created_by_id')" href="#">Requested By <x-column-sort direction="{{ $sortdirection }}" for="reservations.created_by_id" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('reservations.pickup_date')" href="#">Pick-up Date & Time <x-column-sort direction="{{ $sortdirection }}" for="reservations.pickup_date" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('reservations.return_date')" href="#">Return Date & Time <x-column-sort direction="{{ $sortdirection }}" for="reservations.return_date" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('reservations.destination')" href="#">Destination <x-column-sort direction="{{ $sortdirection }}" for="reservations.destination" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-none d-lg-table-cell"><a wire:click="sort('reservations.status')" href="#">Status <x-column-sort direction="{{ $sortdirection }}" for="reservations.status" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell d-lg-none"><a wire:click="sort('reservations.id')" href="#">Details <x-column-sort direction="{{ $sortdirection }}" for="reservations.id" currentsort="{{ $sortby }}"  /></a></th>
                            <th class="cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations_list as $reservations)
                            <tr class="icon" wire:click="onViewDisplay({{$reservations->id}})" >
                                <td class="cell d-none d-lg-table-cell">{{ str_pad($reservations->id, 10, '0', STR_PAD_LEFT) }}</td>
                                {{-- <td class="cell d-none d-lg-table-cell">{{ $reservations->id }}</td> --}}
                                @if (auth()->user()->user_type <= 1  && Gate::allows('access-enabled','module-reservation-approval') == true )
                                    <td class="cell d-none d-lg-table-cell">{{ $reservations->department->name ?? 'Logistic' }}</td>
                                @endif
                                <td class="cell d-none d-lg-table-cell">{{ $reservations->created_by->name }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ date('F d, Y h:i a',strtotime($reservations->pickup_date)) }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ date('F d, Y h:i a',strtotime($reservations->return_date)) }}</td>
                                <td class="cell d-none d-lg-table-cell">{{ $reservations->destination != 0 ? $reservations->destination : 'Multiple Trips'  }}</td>
                                <td class="cell d-none d-lg-table-cell"><span class="badge {{ $reservations->StatusBadge }}">
                                        {{$reservations->StatusString}}
                                        @if ($reservations->status == 0 && now()->subHours(24) > $reservations->date_created)
                                            <span class="text-danger">(Overdue)</span>
                                        @endif
                                    </span>
                                </td>
                                <td class="cell d-lg-none clickable" onclick="window.location.href = '{{ route('department-details',[$reservations->id]) }}'">
                                    <span class="fw-bold">Booking Number: </span> <span>#{{  str_pad($reservations->id, 10, '0', STR_PAD_LEFT) }}</span><br>
                                    <span class="fw-bold">Department: </span> <span>{{ $reservations->department->name ?? 'Logistic'}}</span><br>
                                    <span class="fw-bold">Requested By: </span> <span>{{ $reservations->created_by->name  }}</span><br>
                                    <span class="fw-bold">Pick-up Date & Time : </span> <span>{{ date('F d, Y h:i a',strtotime($reservations->pickup_date)) }}</span><br>
                                    <span class="fw-bold">Return Date & Time : </span> <span>{{ date('F d, Y h:i a',strtotime($reservations->return_date)) }}</span><br>
                                    <span class="fw-bold">Destination: </span> <span>{{ $reservations->destination != 0 ? $reservations->destination : 'Multiple Trips'  }}</span><br>
                                    <span class="fw-bold">Priority Level: </span> <span class="{{$reservations->trip_category->priority_level_color}}">{{ $reservations->trip_category->PriorityLevelString }}</span><br>

                                    <span class="fw-bold">Status: </span> <span @class([
                                        'text-secondary' => $reservations->status == 0,
                                        'text-warning' => $reservations->status == 1,
                                        'text-success' => $reservations->status == 2,
                                        'text-danger' => $reservations->status == 3,
                                        'text-danger' => $reservations->status == 4,
                                        'text-info' => $reservations->status == 5,
                                    ])>
                                        {{ $reservations->StatusString }}
                                            @if ($reservations->status == 0 && now()->subHours(24) > $reservations->pickup_date)
                                                <span class="text-danger">(Overdue)</span>
                                            @endif
                                    </span><br>
                                </td>
                                <td class="cell text-end">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/></svg> --}}
                                    @if ($reservations->status == 2 && auth()->user()->user_type == 0 || auth()->user()->user_type == 1)
                                        <a class="btn btn-link link-info px-1" title="Create Ticket" href="{{ route('trip-create', ['id' => $reservations->id])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                                                <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                                                <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>
                                                </svg>
                                        </a>
                                    @endif
                                    <a class="btn btn-link link-primary px-1" title="View" href="{{ route('reservation-details', ['id' => $reservations->id]) }}">
                                        <i class="fa-eye fa-solid"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="8">NO DATA</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!--//table-responsive-->
        </div><!--//app-card-body-->
    </div><!--//app-card-->
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
                {{ $reservations_list->onEachSide(0)->links() }}
            </div>
        </div>
    </nav><!--//app-pagination-->
</div>
