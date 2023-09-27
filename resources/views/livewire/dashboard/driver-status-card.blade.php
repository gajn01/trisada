<div wire:poll.300s class="col">
    <div class="app-card  app-card-orders-table h-100 shadow-sm " >
        <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h4 class="app-card-title text-marygrace">Driver Status</h4>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//app-card-header-->
        <div class="app-card-body px-3 lg-4" >
            <div class="overflow-auto" style="max-height: 35em">
                <div class="table-responsive">
                    <table class="table table-sm app-table-hovered">
                        <thead>
                            <tr class="cta-color">
                                <th colspan="3">Department: Logistic </th>
                                <th colspan="7" class="text-center">{{ date('Y', strtotime(now()))}}</th>
                            </tr>
                            <tr class="cta-color">
                                <th>Driver Name</th>
                                <th>Driver ID</th>
                                @foreach($date_columns as $cdate)
                                    <th class="text-center">{{date('M d',strtotime($cdate))}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($drivers_list as $v)
                            <tr>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->employee_id }}</td>
                                @foreach($date_columns as $index => $cdate)
                                <td class="text-center fw-semibold">
                                    {!! App\Helpers\AvailabilityHelper::DriverStatusHTML($v->id, $cdate) !!}
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--//app-card-body-->
         <div class="app-card-footer">
            <div class="text-center small p-1">
                <small>Last Updated: {{ date('g:i a', strtotime(now()))}}</small>
            </div>
        </div>
    </div><!--//app-card-->
</div><!--//col-->

