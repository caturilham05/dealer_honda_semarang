<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Products_installments;
use App\Models\ProductsType;
use App\Models\Promo;
use App\Models\Tenor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Products::with(['product_type', 'promo', 'products_installments.tenor']);
        if (!empty(request()->input('id'))) {
            $query->where('id', request()->input('id'));
        }

        if (!empty(request()->input('name'))) {
            $query->where('name', 'LIKE', '%'.addslashes(request()->input('name')).'%');
        }

        $product = $query->orderBy('id', 'desc')->paginate(10);
        $data    = [
            'title'    => 'Mobil',
            'products' => $product,
        ];

        return view('admin.products.products', $data);
    }

    public function product_type()
    {
        $product_type = ProductsType::orderBy('id', 'desc')->paginate(10);
        $data = [
            'title'         => 'Tipe Mobil',
            'product_types' => $product_type,
        ];

        return view('admin.products.products_type', $data);
    }

    public function product_promo()
    {
        $promo = Promo::orderBy('id', 'desc')->paginate(10);
        $data = [
            'title'  => 'Promo Mobil',
            'promos' => $promo
        ];

        return view('admin.products.products_promo', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function product_create()
    {
        $product_type = ProductsType::select('id', 'name')->where('is_active', 1)->orderBy('id', 'desc')->get();
        $promo        = Promo::select('id', 'name')->where('is_active', 1)->orderBy('id', 'desc')->get();
        $data         = [
            'title'         => 'Tambah Mobil Baru',
            'product_types' => $product_type,
            'promos'        => $promo,
            'tenors'        => Tenor::get()
        ];
        return view('admin.products.products_create', $data);
    }

    public function product_type_create()
    {
        $data = [
            'title' => 'Tambah Tipe Mobil Baru',
        ];
        return view('admin.products.products_type_create', $data);
    }

    public function product_promo_create()
    {
        $data = [
            'title' => 'Buat Promo Baru',
        ];
        return view('admin.products.products_promo_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function product_store(Request $request)
    {
        $this->validate($request,[
                'product_type_id' => 'required|integer',
                'name'            => 'required',
                'price'           => 'required',
            ],
            [
                'name.required'            => 'Nama mobil tidak boleh kosong',
                'price.required'           => 'Harga mobil tidak boleh kosong',
                'product_type_id.required' => 'Tipe mobil tidak boleh kosong',
                'product_type_id.integer'  => 'Tipe mobil harus berupa angka',
            ]
        );

        $request->price = str_replace('.', '', $request->price);
        $request->price = $request->price;

        try {

            DB::beginTransaction();
            if ($request->hasFile('images'))
            {
                $files = [];
                foreach ($request->file('images') as $file) {
                    if ($file->isValid()) {
                        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                        $file->storeAs('public/products', $filename);
                        $files[] = [
                            'images' => $filename,
                        ];
                    }
                }
            }

            if ($request->hasFile('brochure'))
            {
                $brochure = [];
                foreach ($request->file('brochure') as $file_brochure) {
                    if ($file_brochure->isValid()) {
                        $filename_brochure = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file_brochure->getClientOriginalName());
                        $file_brochure->storeAs('public/products/brochure', $filename_brochure);
                        $brochure[] = [
                            'brochure' => $filename_brochure,
                        ];
                    }
                }
            }

            $post = [
                'product_type_id' => $request->product_type_id,
                'promo_id'        => $request->promo_id,
                'name'            => $request->name,
                'price'           => $request->price,
                'specification'   => $request->specification,
                'special_feature' => $request->special_feature,
                'description'     => $request->description,
                'is_active'       => !empty($request->is_active) ? 1 : 0,
                'image'           => !empty($files) ? $files[0]['images'] : null,
                'images'          => $files ?? NULL,
                'brochure'        => $brochure ?? NULL,
            ];

            $last_id = Products::create($post);

            if (!empty($request->price_installment)) {
                foreach ($request->price_installment as $key => $val_price) {
                    if (!empty($val_price)) {
                        $val_price          = str_replace('.', '', $val_price);
                        $post_installment[] = [
                            'product_id'        => $last_id->id,
                            'price_installment' => $val_price,
                            'tenor_id'          => $request->tenor[$key],
                            'tdp'               => $request->tdp[$key],
                        ];
                    }
                }
            }
            Products_installments::insert($post_installment);
            DB::commit(); // <= Commit the changes
        } catch (Exception $e) {
            DB::rollBack(); // <= Rollback in case of an exception
            dd($e);
        }
        return redirect()->route('admin.products_list')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->name)]);
    }

    public function product_type_store(Request $request)
    {
        $request->price = str_replace('.', '', $request->price);
        $request->price = $request->price;

        $this->validate($request,[
                'name'  => 'required',
                'price' => 'required',
                'years' => 'required|integer',
            ],
            [
                'name.required'  => 'Nama menu tidak boleh kosong',
                'price.required' => 'Route tidak boleh kosong',
                'years.required' => 'Prefix tidak boleh kosong',
                'years.integer'  => 'inputan harus berupa angka',
            ]
        );

        $post = [
            'name'      => $request->name,
            'price'     => $request->price,
            'years'     => $request->years,
            'is_active' => !empty($request->is_active) ? 1 : 0
        ];

        ProductsType::create($post);
        return redirect()->route('admin.products_type')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->name)]);
    }

    public function product_promo_store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'price' => 'required'
        ]);

        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/promo', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }
        }

        $request->price = str_replace('.', '', $request->price);
        $request->price = $request->price;

        $post = [
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => !empty($files) ? $files[0]['images'] : null,
            'images'      => $files ?? NULL,
            'is_active'   => !empty($request->is_active) ? 1 : 0
        ];

        Promo::create($post);
        return redirect()->route('admin.products.promo')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->name)]);
    }

    /**
     * Display the specified resource.
     */
    public function show_product(Products $products, $id)
    {
        // dd($products->findOrFail($id), $id);
        // $data = [
        //     'title'   => 'Promo Mobil',
        //     'product' => $products->findOrFail($id)
        // ];

        // return view('admin.products.products_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_product(Products $products, $id)
    {
        $product      = $products->with('product_type', 'promo', 'products_installments')->where('id', $id)->first();
        $product_type = ProductsType::select('id', 'name')->where('is_active', 1)->orderBy('id', 'desc')->get();
        $promo        = Promo::select('id', 'name')->where('is_active', 1)->orderBy('id', 'desc')->get();
        $data         = [
            'title'         => 'Edit '.$product->name,
            'product'       => $product,
            'product_types' => $product_type,
            'promos'        => $promo,
            'tenors'        => Tenor::get()
        ];

        return view('admin.products.products_edit', $data);
    }

    public function edit_product_type(ProductsType $product_type, $id)
    {
        $product_type = $product_type->where('id', $id)->first();
        $data         = [
            'title' => 'Edit Tipe '.$product_type->name,
            'item'  => $product_type
        ];

        return view('admin.products.products_type_edit', $data);
    }

    public function edit_promo(Promo $promo, $id)
    {
        $promo = $promo->where('id', $id)->first();
        $data = [
            'title'  => 'Edit Promo '.$promo->name,
            'item' => $promo
        ];

        return view('admin.products.products_promo_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_product(Request $request, $id)
    {
        $this->validate($request,[
                'product_type_id' => 'required|integer',
                'name'            => 'required',
            ],
            [
                'name.required'            => 'Nama menu tidak boleh kosong',
                'product_type_id.required' => 'Tipe produk tidak boleh kosong',
                'product_type_id.integer'  => 'Tipe produk harus berupa angka',
            ]
        );

        $request->price = str_replace('.', '', $request->price);
        $request->price = $request->price;

        try {
            $product             = Products::findOrFail($id);
            $product_installment = Products_installments::where('product_id', $id)->get();

            if (!empty($request->price_installment)) {
                foreach ($request->price_installment as $key => $val_price) {
                    if (!empty($val_price)) {
                        $val_price          = str_replace('.', '', $val_price);
                        $post_installment[] = [
                            'product_id'        => $id,
                            'price_installment' => $val_price,
                            'tenor_id'          => $request->tenor[$key],
                            'tdp'               => $request->tdp[$key],
                        ];
                    }
                }
            }

            if (!$product_installment->isEmpty()) {
                $deleted = Products_installments::where('product_id', $id)->delete();
                if ($deleted) {
                    Products_installments::insert($post_installment);
                }
            } else {
                Products_installments::insert($post_installment);
            }

            if ($request->hasFile('images'))
            {
                $files = [];
                foreach ($request->file('images') as $file) {
                    if ($file->isValid()) {
                        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                        $file->storeAs('public/products', $filename);
                        $files[] = [
                            'images' => $filename,
                        ];
                    }
                }

                if (!empty($product->images)) {
                    foreach ($product->images as $image) {
                        //delete old image
                        Storage::delete('public/products/'.$image['images']);
                    }
                }
            }

            if ($request->hasFile('brochure'))
            {
                $brochure = [];
                foreach ($request->file('brochure') as $file_brochure) {
                    if ($file_brochure->isValid()) {
                        $filename_brochure = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file_brochure->getClientOriginalName());
                        $file_brochure->storeAs('public/products/brochure', $filename_brochure);
                        $brochure[] = [
                            'brochure' => $filename_brochure,
                        ];
                    }
                }

                if (!empty($product->brochure)) {
                    foreach ($product->brochure as $image) {
                        //delete old image
                        Storage::delete('public/products/brochure/'.$image['brochure']);
                    }
                }
            }

            $post = [
                'product_type_id' => $request->product_type_id,
                'promo_id'        => $request->promo_id,
                'name'            => $request->name,
                'price'           => $request->price,
                'specification'   => $request->specification,
                'special_feature' => $request->special_feature,
                'description'     => $request->description,
                'is_active'       => !empty($request->is_active) ? 1 : 0,
                'image'           => !empty($files) ? $files[0]['images'] : $product->image,
                'images'          => $files ?? $product->images,
                'brochure'        => $brochure ?? $product->brochure,
            ];

            $product->update($post);
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->route('admin.products_list')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->name)]);
    }

    public function update_product_active(Request $request, $id){
        if (request()->ajax()) {
            $product            = Products::find($id);
            $product->is_active = $request->is_checked;
            if (!$product->update()) {
                return response()->json([
                    'message' => 'Gagal mengaktifkan '.$product->name,
                ]);
            }
            return response()->json([
                    'message' => 'Berhasil mengaktifkan '.$product->name,
            ]);
        }
    }

    public function update_promo(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $promo = Promo::findOrFail($id);

        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/promo', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }

            if (!empty($promo->images)) {
                foreach ($promo->images as $image) {
                    //delete old image
                    Storage::delete('public/promo/'.$image['images']);
                }
            }
        }

        $update = [
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => !empty($files) ? $files[0]['images'] : $promo->image,
            'images'      => $files ?? $promo->images,
            'is_active'   => !empty($request->is_active) ? 1 : 0
        ];

        $promo->update($update);
        return redirect()->route('admin.products.promo')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->name)]);
    }

    public function update_promo_active(Request $request, $id){
        if (request()->ajax()) {
            $promo            = Promo::find($id);
            $promo->is_active = $request->is_checked;
            if (!$promo->update()) {
                return response()->json([
                    'message' => 'Gagal mengaktifkan promo '.$promo->name,
                ]);
            }
            return response()->json([
                    'message' => 'Berhasil mengaktifkan promo '.$promo->name,
            ]);
        }
    }

    public function update_product_type(Request $request, $id)
    {
        $request->price = str_replace('.', '', $request->price);
        $request->price = $request->price;
        $this->validate($request,[
                'name'  => 'required',
                'price' => 'required',
                'years' => 'required|integer',
            ],
            [
                'name.required'  => 'Nama menu tidak boleh kosong',
                'price.required' => 'Route tidak boleh kosong',
                'years.required' => 'Prefix tidak boleh kosong',
                'years.integer'  => 'inputan harus berupa angka',
            ]
        );

        $product_type = ProductsType::findOrFail($id);
        $post = [
            'name'      => $request->name,
            'price'     => $request->price,
            'years'     => $request->years,
            'is_active' => !empty($request->is_active) ? 1 : 0
        ];
        $product_type->update($post);
        return redirect()->route('admin.products_type')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->name)]);
    }

    public function update_product_type_active(Request $request, $id){
        if (request()->ajax()) {
            $product_type            = ProductsType::find($id);
            $product_type->is_active = $request->is_checked;
            if (!$product_type->update()) {
                return response()->json([
                    'message' => 'Gagal mengaktifkan tipe '.$product_type->name,
                ]);
            }
            return response()->json([
                'message' => 'Berhasil mengaktifkan tipe '.$product_type->name,
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy_product($id)
    {
        $product = Products::findOrFail($id);

        if (!empty($product->images)) {
            foreach ($product->images as $image) {
                //delete old image
                Storage::delete('public/products/'.$image['images']);
            }
        }

        Products_installments::where('product_id', $id)->delete();
        $product->delete();
        return redirect()->route('admin.products_list')->with(['success' => sprintf('%s Berhasil Dihapus.', $product->name)]);
    }

    public function destroy_product_type($id)
    {
        $product_type = ProductsType::findOrFail($id);
        $product_type->delete();
        return redirect()->route('admin.products_type')->with(['success' => sprintf('%s Berhasil Dihapus.', $product_type->name)]);
    }

    public function destroy_promo($id)
    {
        $promo = Promo::findOrFail($id);

        if (!empty($promo->images)) {
            foreach ($promo->images as $image) {
                //delete old image
                Storage::delete('public/promo/'.$image['images']);
            }
        }

        $promo->delete();
        return redirect()->route('admin.products.promo')->with(['success' => sprintf('%s Berhasil Dihapus.', $promo->name)]);
    }

    public function product_installment_view()
    {
        if (request()->ajax()) {
            $data = [
                'tenors' => Tenor::get()
            ];
            $html = view('admin.products.products_create_installment', $data)->render();
            return response()->json([
                'html'   => $html,
                'tenors' => $data['tenors']
            ]);
        }
    }
}
