<?php

namespace App\Http\Controllers\Paid;

use Illuminate\View\View;

class FunctionalityController
{
    /**
     * Display admin panel
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view('paid/index');
    }
}
