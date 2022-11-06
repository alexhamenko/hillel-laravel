<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LocalizationController
{
    public function __invoke($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
