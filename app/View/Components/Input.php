<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public $label = '',
        public $type = 'text',
        public $name = null
    ) {}

    public function render()
    {
        return view('components.input');
    }
}
