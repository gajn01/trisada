@if($attributes->has('direction') && $attributes->has('for') && $attributes->has('currentsort'))
    @if($attributes->get('direction') == 'asc' && $attributes->get('for') == $attributes->get('currentsort'))
       <i class="fa fa-sort-amount-up-alt"></i>
    @elseif($attributes->get('direction') == 'desc'  && $attributes->get('for') == $attributes->get('currentsort'))
    <i class="fa fa-sort-amount-down"></i>
    @else
    <i class="fa fa-sort"></i>
    @endif

@else
    <i class="fa fa-sort"></i>
@endif
