<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $sliderBanners = Banner::where('type', 'Slider')
                               ->where('status', 1)
                               ->get()
                               ->toArray();
        $fixBanners = Banner::where('type', 'Fix')
                               ->where('status', 1)
                               ->get()
                               ->toArray();

        $newProducts = Product::orderBy('id','desc')
                               ->where('status',1)
                               ->limit(4)
                               ->get()
                               ->toArray();
        return view('front.index',compact('sliderBanners', 'fixBanners','newProducts'));
    }
}
