<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Country as Country;

class CountryViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $countries;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Country $countries)
    {
        // Dependencies automatically resolved by service container...
        $this->countries = $countries;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countries', $this->countries->list());
    }
}
