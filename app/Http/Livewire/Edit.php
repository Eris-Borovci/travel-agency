<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Edit extends Component
{
    public $property;

    public $property_name, $property_selection, $max_people, $price, $living_room, $bedroom, $bathroom;


    public function mount($property){
        $this->fill([
            'property' => $property,
            'property_name' => $property->property_name,
            'property_selection' => $property->property_selection,
            'max_people' => $property->max_people,
            "price" => $property->price,
            "living_room" => json_decode($property->rooms_details)->livingRoom,
            "bedroom" => json_decode($property->rooms_details)->bedroom,
            "bathroom" => json_decode($property->rooms_details)->bathroom,
        ]);
    }

    public function reset_value($var_name) {
        switch ($var_name) {
            case 'property_name':
                $this->property_name = $this->property->property_name;
                break;
            case 'property_selection':
                $this->property_selection = $this->property->property_selection;
                break;
            case 'max_people':
                $this->max_people = $this->property->max_people;
                break;
            case 'price':
                $this->price = $this->property->price;
                break;
            case 'living_room':
                $this->living_room = json_decode($this->property->rooms_details)->livingRoom;
                break;
            case 'bedroom':
                $this->bedroom = json_decode($this->property->rooms_details)->bedroom;
                break;
            case 'bathroom':
                $this->bathroom = json_decode($this->property->rooms_details)->bathroom;
                break;
            default:
                # code...
                break;
        }
    }

    public function render()
    {
        return view('livewire.edit');
    }
}
