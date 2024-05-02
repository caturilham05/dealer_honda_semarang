<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\Products;
use App\Models\Contacts;
use App\Models\Images;

class HomeController extends Controller
{
    public function index()
    {
        $imageslider = Images::orderBy('id', 'asc')->get()->toArray();
        $content = Content::with(['content_type'])->orderBy('id', 'asc')->get()->toArray();
        $product = Products::with(['product_type', 'promo'])->where('is_active', 1)->orderBy('id', 'asc')->skip(0)->take(5)->get()->toArray();
        // dd($product);
        $data    = [
            'datas'       => $content,
            'products'    => $product,
            'contact'     => Contacts::get()->first()->toArray(),
            'imageslider' => $imageslider
        ];
        return view('public.home', $data);
    }
}
