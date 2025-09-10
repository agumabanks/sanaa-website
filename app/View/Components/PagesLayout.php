<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PagesLayout extends Component
{
    public $title;
    public $metaDescription;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $metaDescription = null)
    {
        $this->title = $title;
        $this->metaDescription = $metaDescription;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.pages-layout');
    }
}