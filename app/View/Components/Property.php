<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Property extends Component
{
    public $image;
    public $title;
    public $redirect;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $title, $redirect)
    {
        $this->image = $image;
        $this->title = $title;
        $this->redirect = $redirect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.property');
    }
}
