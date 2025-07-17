<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarRating extends Component
{
    public $rating;
    public $reviewCount;

    public function __construct($rating, $reviewCount = null)
    {
        $this->rating = $rating;
        $this->reviewCount = $reviewCount;
    }

    public function render()
    {
        return view('components.star-rating');
    }
}
