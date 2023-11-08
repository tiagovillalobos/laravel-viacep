<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{    
    public string $classes = 'form-control';
    public string $dataAttributes = '';

    public string $label;
    public string $name;
    public string $type;
    public string $mask;
    public string $ajax;
    public bool $optional;
    public string $target;
    public bool $readonly;

    public function __construct(string $label = '', string $name, string $type = 'text', string $mask = '', string $ajax = '', bool $optional = false, string $target = '', bool $readonly = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->mask = $mask;
        $this->ajax = $ajax;
        $this->optional = $optional;
        $this->target = $target;
        $this->readonly = $readonly;

        $this->addMaskClass();
        $this->addDataAttributes();
    }

    public function hasMask() {
        return $this->mask != '';
    }

    private function addMaskClass() {
        if($this->mask != '') $this->classes .= ' mask-' . $this->mask;   
    }

    private function addDataAttributes() {
        if($this->ajax != '')   $this->dataAttributes .= " data-ajax=$this->ajax";
        if($this->target != '') $this->dataAttributes .= " data-target=$this->target";
    }

    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
