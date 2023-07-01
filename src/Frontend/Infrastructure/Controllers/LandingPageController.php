<?php

namespace App\Src\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as ApplicationAlias;

class LandingPageController extends Controller
{
    public function __invoke(): View|ApplicationAlias|Factory|Application
    {
        return view('frontend.home.index');
    }
}
