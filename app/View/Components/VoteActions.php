<?php

namespace App\View\Components;

use Closure;
use App\Models\Feature;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class VoteActions extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Feature $feature)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.vote-actions');
    }
}
