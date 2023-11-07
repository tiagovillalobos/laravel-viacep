<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{    
    public string $classes = 'form-control';
    public string $label;
    public string $name;
    public string $type;
    public string $mask;

    public function __construct(string $label = '', string $name, string $type = 'text', string $mask = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->mask = $mask;

        $this->addMaskClass();
    }

    public function hasMask() {
        return $this->mask != '';
    }

    private function addMaskClass() {
        if($this->mask != '') $this->classes .= ' mask-' . $this->mask;   
    }

    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
