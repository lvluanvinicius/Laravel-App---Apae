<?php

namespace App\View\Components\Website;

use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecentsNews extends Component
{
    /**
     * Guarda modelo de notícias.
     *
     * @var Collection
     */
    public \Illuminate\Database\Eloquent\Collection $news;

    /**
     * Create a new component instance.
     */
    public function __construct(\App\Models\News $news)
    {
        $this->news = $news->getRecentNews();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.recents-news');
    }
}
