<?php

namespace App\Src\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        return view('frontend.home.index');
    }
}
