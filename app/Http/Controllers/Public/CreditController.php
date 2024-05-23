<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Products;
use App\Models\ProductsType;
use App\Models\Contacts;

class CreditController extends Controller
{
    protected $credits;
    protected $contacts;
    protected $product_types;
    protected $data_view;

    public function __construct(
        Credit $credits,
        Contacts $contacts,
        ProductsType $productTypes,

    )
    {
        $this->credits       = $credits->where('is_active', 1)->get()->first()->toArray();
        $this->contacts      = $contacts->get()->first()->toArray();
        $this->product_types = $productTypes->where('is_active', 1)->get()->toArray();
        $this->data_view     = [
            'credits'       => $this->credits,
            'contact'       => $this->contacts,
            'product_types' => $this->product_types,
        ];
    }

    public function credit_terms()
    {
        $this->data_view['title']        = 'Syarat Kredit';
        $this->data_view['meta_content'] = 'Honda Semarang Center juga melayani pembelian mobil Honda dengan melalui kredit. Kami bantu proses sampai di approve oleh pihak leasing. Berikut beberapa berkas dan persyaratan yang di butuhkan untuk pengajuan kredit mobil Honda Semarang Center';
        $this->data_view['meta_keyword'] = 'kredit, honda, mobil, dealer, semarang, kredit honda, kredit honda mobil, kredit honda mobil dealer, kredit honda mobil dealer semarang, syarat kredit, syarat kredit honda mobil, syarat kredit mobil semarang';
        return view('public.credits.credit_terms', $this->data_view);
    }

    public function credit_simulation()
    {
        $this->data_view['title'] = 'Simulasi Kredit';
        $this->data_view['meta_content'] = 'Honda Semarang Center juga melayani pembelian mobil Honda dengan melalui kredit. Kami bantu proses sampai di approve oleh pihak leasing. Berikut beberapa berkas dan persyaratan yang di butuhkan untuk pengajuan kredit mobil Honda Semarang Center';
        $this->data_view['meta_keyword'] = 'kredit, honda, mobil, dealer, semarang, kredit honda, kredit honda mobil, kredit honda mobil dealer, kredit honda mobil dealer semarang, syarat kredit, syarat kredit honda mobil, syarat kredit mobil semarang';
        return view('public.credits.credit_simulation', $this->data_view);
    }

    public function product_types($id)
    {
        if (request()->ajax()) {
            $products = Products::where('product_type_id', $id)->get()->toArray();
            $data = [
                'products' => $products
            ];
            $html     = view('public.credits.credit_simulation_search', $data)->render();
            return response()->json([
                'products' => $products,
                'html'     => $html,
            ]);
        }
    }

    public function car($id)
    {
        if (request()->ajax()) {
            $product = Products::with(['product_type', 'promo', 'products_installments.tenor'])->findOrFail($id)->toArray();
            $data = [
                'product' => $product
            ];
            $html = view('public.credits.credit_simulation_search_car', $data)->render();
            return response()->json([
                'product' => $product,
                'html'    => $html,
            ]);
        }
    }
}
