<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class PanelController
{
    /**
     * Display admin panel
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view('admin/panel');
    }
}
