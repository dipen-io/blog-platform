<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class BookmarkedPosts extends Component
{
    public Collection $bookmarkedPosts;
    /**
     * Create a new component instance.
     */
    public function __construct($bookmarkedPosts)
    {
        $this->bookmarkedPosts = $bookmarkedPosts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bookmarked-posts');
    }
}
