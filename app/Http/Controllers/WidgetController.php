<?php

namespace App\Http\Controllers;

class WidgetController extends Controller
{
    public function create()
    {
        return view('guest.widget');
    }
}