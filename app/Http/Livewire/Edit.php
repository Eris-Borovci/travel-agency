<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Edit extends Component
{
    public $property;

    public $property_name, $property_selection, $max_people, $price, $living_room, $bedroom, $bathroom, $main_photo, $photos = array(), $removed_photos = array(), $single_photo;


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
            "main_photo" => $property->photos()->where("is_main", 1)->first(),
            "photos" => $property->photos()->where("is_main", 0)->get()
        ]);
    }

    public function add_photo(){}
    public function change_main_photo($photo){
        $this->single_photo = $photo;

        if(gettype($this->photos) == 'array') {
            $newPhotos = $this->photos;
        } else {
            $newPhotos = $this->photos->all();
        }

        array_push($newPhotos, $this->main_photo);

        $this->fill(['photos' => $newPhotos]);


        array_push($this->removed_photos, $photo);
        $this->main_photo = $photo;
    }
    public function remove_photo(){}

    public function reset_values() {
        $this->fill([
            'property_name' => $this->property->property_name,
            'property_selection' => $this->property->property_selection,
            'max_people' => $this->property->max_people,
            "price" => $this->property->price,
            "living_room" => json_decode($this->property->rooms_details)->livingRoom,
            "bedroom" => json_decode($this->property->rooms_details)->bedroom,
            "bathroom" => json_decode($this->property->rooms_details)->bathroom,
            "main_photo" => $this->property->photos()->where("is_main", 1)->first(),
            "photos" => $this->property->photos()->where("is_main", 0)->get()
        ]);
    }

    public function render()
    {
        return view('livewire.edit');
    }
}
