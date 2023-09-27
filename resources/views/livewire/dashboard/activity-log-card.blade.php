
<div wire:poll.60s wire:key="activity-logs" class="col mt-4">
    <div class="app-card  app-card-orders-table h-100 shadow-sm ">
        <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h4 class="app-card-title text-marygrace">Activity Logs</h4>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//app-card-header-->
        <div class="app-card-body px-3 lg-4" >
            <div class="container overflow-auto" style="height: 20em">
                @forelse($logs as $l)
                    <p>{{ date('F d, Y | h:i A', strtotime($l->date_created)) }} - {{ $l->text }}</p>
                    <hr>
                @empty
                    No logs found.
                @endforelse
            </div>
        </div><!--//app-card-body-->
         <div class="app-card-footer">
            <div class="text-center small p-1">
                <small>Last Updated: {{ date('g:i a', strtotime(now()))}}</small>
            </div>
        </div>
    </div><!--//app-card-->
</div><!--//col-->


