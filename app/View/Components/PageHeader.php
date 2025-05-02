<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public $title;
    public $subtitle;
    public $color;

    public function __construct($title, $subtitle = null, $color = 'blue')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->color = $color;
    }
    public function render(): View|Closure|string
    {
        return view('components.page-header');
    }
}
