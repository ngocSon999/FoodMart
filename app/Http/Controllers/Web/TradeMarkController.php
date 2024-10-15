<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TradeMark;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TradeMarkController extends Controller
{
    public function getBySlug($trademark = '', $slug = ''): View
    {
        $trademarks = Trademark::where('slug', $trademark)->first();
        $trademarkChild = $trademarks->children()->get();

        return view('trademark.by_slug', compact('trademarks', 'slug'));
    }
}
