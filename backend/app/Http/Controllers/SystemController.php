<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class SystemController extends Controller
{
    public function setLang($locale)
    {
        if (in_array($locale, ['en', 'es'])) { 
            App::setLocale($locale); 
            Session::put('locale', $locale); 
        } else {
            Session::put('locale', 'en'); 
        }
        return redirect()->back();
    }

}
