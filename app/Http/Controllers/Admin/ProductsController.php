<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\ProductsType;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Produk'
        ];

        return view('admin.products.products', $data);
    }

    public function product_type()
    {
        $product_type = ProductsType::orderBy('id', 'desc')->paginate(10);
        $data = [
            'title'         => 'Tipe Produk',
            'product_types' => $product_type,
        ];

        return view('admin.products.products_type', $data);
    }

    public function product_promo()
    {
        $promo = Promo::orderBy('id', 'desc')->paginate(10);
        $data = [
            'title'  => 'Promo Produk',
            'promos' => $promo
        ];

        return view('admin.products.products_promo', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function product_create()
    {
        $data = [
            'title' => 'Product Create',
        ];
        return view('admin.products.products_create', $data);
    }

    public function product_type_create()
    {
        $data = [
            'title' => 'Product Type Create',
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
        //
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
            'name' => 'required',
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

        $post = [
            'name'        => $request->name,
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
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    public function edit_promo(Promo $promo, $id)
    {
        $promo = $promo->where('id', $id)->first();
        $data = [
            'title'  => 'Edit Promo',
            'item' => $promo
        ];

        return view('admin.products.products_promo_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
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
        }

        if (!empty($promo->images)) {
            foreach ($promo->images as $image) {
                //delete old image
                Storage::delete('public/promo/'.$image['images']);
            }
        }

        $update = [
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => !empty($files) ? $files[0]['images'] : null,
            'images'      => $files ?? NULL,
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
                    'message' => 'error set active promo',
                ]);
            }
            return response()->json([
                'message' => 'success set active promo',
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
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

        //delete image
        $promo->delete();
        return redirect()->route('admin.products.promo')->with(['success' => sprintf('%s Berhasil Dihapus.', $promo->name)]);
    }
}
