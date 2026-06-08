<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function app(): View
    {
        return view('pages.app');
    }

    public function portfolio(): View
    {
        return view('pages.portfolio');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function investors(): View
    {
        return view('pages.investors');
    }
}
