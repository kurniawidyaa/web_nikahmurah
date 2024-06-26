<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FrontLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public function __construct()
    {
        $this->title = $title ?? "NikahMurahTangerang";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.front_master', ['title' => '']);
    }
}
