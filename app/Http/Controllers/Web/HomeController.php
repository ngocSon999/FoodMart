<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TradeMark;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index($slug = ''): View
    {
        $trademarks = Trademark::all();
        if ($trademarks->contains('slug', $slug) || $slug == '') {
            return view('home', compact('trademarks', 'slug'));
        }
         abort(404);
    }
}
