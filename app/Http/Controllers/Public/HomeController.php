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
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $imageslider = Images::orderBy('id', 'asc')->get()->toArray();
        $content     = Content::with(['content_type'])->orderBy('id', 'Desc')->get()->toArray();
        $product     = Products::with(['product_type', 'promo'])->where('is_active', 1)->orderBy('id', 'asc')->skip(0)->take(5)->get()->toArray();
        $testimonial = Testimonial::orderBy('id', 'desc')->get()->toArray();
        $data    = [
            'datas'        => $content,
            'products'     => $product,
            'contact'      => Contacts::get()->first()->toArray(),
            'imageslider'  => $imageslider,
            'testimonial'  => $testimonial,
            'meta_content' => 'Selamat datang di Dealer Resmi Mobil Honda Jawa Tengah. Coverage area Semarang, Demak, Kudus, Grobogan, Pati, Purwodadi, Kendal, Ambarawa, Pekalongan, Tegal, Batang, Kendal, Solo, Surakarta, Salatiga, Pemalang, Brebes, untuk anda yang ada di area Semarang Jateng lagi mencari Harga Teringan Mobil Honda Brio Di Semarang 2023 maka sahabat Honda datang di tempat yang tepat',
            'meta_keyword' => $data['datas'][0] ?? ''
        ];
        return view('public.home', $data);
    }
}
