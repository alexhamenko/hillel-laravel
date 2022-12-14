<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController
{
    /**
     * Display homepage
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view('index');
    }
}
