<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Category as Cat;

class CategoryViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $categories;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Cat $categories)
    {
        // Dependencies automatically resolved by service container...
        $this->categories = $categories;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories->list());
    }
}
