<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocalizationController
{
    /**
     * Change current language into specified in the $locale argument
     *
     * @param $locale
     * @return RedirectResponse
     */
    public function __invoke($locale): RedirectResponse
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
