<div>
    <input wire:model="address" type="text" placeholder="Enter an address">
    <button wire:click="getCoordinates">Get Coordinates</button>

    @if ($latitude && $longitude)
        <p>Latitude: {{ $latitude }}</p>
        <p>Longitude: {{ $longitude }}</p>
    @endif
</div>
