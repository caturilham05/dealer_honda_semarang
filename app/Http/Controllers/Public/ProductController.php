<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsType;
use App\Models\Contacts;

class ProductController extends Controller
{
    protected $contacts;
    protected $products;
    protected $product_type;
    protected $data_view;

    public function __construct(
        Contacts $contacts,
        Products $products,
        ProductsType $productType
    )
    {
        $this->contacts     = $contacts->get()->first()->toArray();
        $this->products     = $products->with(['product_type', 'promo'])->where('is_active', 1)->orderBy('id', 'desc')->get()->toArray();
        $this->product_type = $productType->where('is_active', 1)->orderBy('id', 'desc')->get()->toArray();
        $this->data_view    = [
            'contact'      => $this->contacts,
            'products'     => $this->products,
            'product_type' => $this->product_type
        ];

    }

    public function product_list()
    {
        $this->data_view['title'] = 'Daftar Mobil';
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

}
