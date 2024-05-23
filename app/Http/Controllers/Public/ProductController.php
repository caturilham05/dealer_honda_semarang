<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsType;
use App\Models\Contacts;
use App\Models\Promo;

class ProductController extends Controller
{
    protected $contacts;
    protected $products;
    protected $product_type;
    protected $promo;
    protected $data_view;

    public function __construct(
        Contacts $contacts,
        Products $products,
        ProductsType $productType,
        Promo $promo
    )
    {
        $this->contacts     = $contacts->get()->first()->toArray();
        $this->products     = $products->with(['product_type', 'promo', 'products_installments.tenor'])->where('is_active', 1)->orderBy('id', 'desc')->get()->toArray();
        $this->product_type = $productType->where('is_active', 1)->orderBy('id', 'desc')->get()->toArray();
        $this->promo        = $promo->where('is_active', 1)->orderBy('id', 'desc')->get()->first()->toArray();
        $this->data_view    = [
            'contact'      => $this->contacts,
            'products'     => $this->products,
            'product_type' => $this->product_type,
            'promos'       => $this->promo
        ];

    }

    public function product_list()
    {
        $this->data_view['title']        = 'Daftar Mobil';
        $car_names                       = implode(', ', array_column($this->data_view['products'], 'name'));
        $this->data_view['meta_content'] = $this->data_view['contact']['description'];
        $this->data_view['meta_keyword'] = $car_names;
        return view('public.products.product', $this->data_view);
    }

    public function product_list_items($id)
    {
        if (request()->ajax()) {
            if (!empty($id)) {
                $products = Products::with(['product_type', 'promo'])
                ->where('product_type_id', $id)
                ->where('is_active', 1)
                ->orderBy('id', 'desc')
                ->get()->toArray();
            }else{
                $products = $this->products;
            }

            $data = [
                'products'     => $products,
                'product_type' => $this->product_type
            ];

            $html = view('public.products.product_items', $data)->render();
            return response()->json([
                'html' => $html
            ]);
        }
    }

    public function price_list()
    {
        $this->data_view['title'] = 'Daftar Harga Mobil';
        return view('public.products.product_price_list', $this->data_view);
    }

    public function price_list_items($id)
    {
        if (request()->ajax()) {
            if (!empty($id)) {
                $products = Products::with(['product_type', 'promo'])
                ->where('product_type_id', $id)
                ->where('is_active', 1)
                ->orderBy('id', 'desc')
                ->get()->toArray();
            }else{
                $products = $this->products;
            }

            $data = [
                'products'     => $products,
                'product_type' => $this->product_type
            ];

            $html = view('public.products.product_price_list_items', $data)->render();
            return response()->json([
                'id'       => $id,
                'products' => $products,
                'html'     => $html
            ]);
        }
    }

    public function detail($id)
    {
        $this->data_view['product_detail'] = Products::with(['product_type', 'promo', 'products_installments.tenor'])->where('id', $id)->first()->toArray();
        $this->data_view['is_detail']      = true;
        $this->data_view['meta_content']   = $this->data_view['product_detail']['name'];
        $this->data_view['meta_keyword']   = $this->data_view['product_detail']['name'];
        return view('public.products.product_detail', $this->data_view);
    }

    public function promo()
    {
        $this->data_view['title']        = 'Promo';
        $this->data_view['meta_content'] = $this->data_view['promos']['name'];
        $this->data_view['meta_keyword'] = 'promo honda, promo mobil honda, promo honda mobil, promo honda semarang, promo honda dealer semarang, promo mobil semarang, promo semarang, promo honda';
        return view('public.products.promo', $this->data_view);
    }

    public function promo_detail($id)
    {
        $this->data_view['promo_detail'] = Promo::where('id', $id)->first()->toArray();
        // dd($this->data_view);
        return view('public.products.promo_detail', $this->data_view);
    }
}
