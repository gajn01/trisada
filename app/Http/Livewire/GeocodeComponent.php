<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class GeocodeComponent extends Component
{
    public $address;
    public $latitude;
    public $longitude;

    public function getCoordinates()
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $this->address,
            'key' => 'AIzaSyBNMl4BczTuNsxGnImHOGIo-xDWEs5-9U0', // Replace with your API key
        ]);

        $data = $response->json();

        if ($data['status'] === 'OK') {
            $location = $data['results'][0]['geometry']['location'];
            $this->latitude = $location['lat'];
            $this->longitude = $location['lng'];
        }
        dd($data);
    }

    public function render()
    {

        return view('livewire.geocode-component');
    }
}
