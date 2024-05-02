<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\ImagesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Images',
        ];

        return view('admin.dashboard', $data);
    }

    public function imageslider()
    {
        $imageslider = Images::with('imageslider_category')->orderBy('id', 'desc')->paginate(10);
        $data        = [
            'title'       => 'Imageslider',
            'imageslider' => $imageslider
        ];
        return view('admin.images.imageslider', $data);
    }

    public function imageslider_category()
    {
        $imageslider_category = ImagesCategory::paginate(10);
        $data = [
            'title'                  => 'Imageslider Kategori',
            'imageslider_categories' => $imageslider_category
        ];

        return view('admin.images.imageslider_category', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function imageslider_create()
    {
        $imageslider_category = ImagesCategory::orderBy('id', 'desc')->get();
        $data = [
            'title'                  => 'Imageslider Create',
            'imageslider_categories' => $imageslider_category
        ];
        return view('admin.images.imageslider_create', $data);
    }

    public function imageslider_category_create()
    {
        $data = [
            'title' => 'Imageslider Category Create'
        ];
        return view('admin.images.imageslider_category_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function imageslider_store(Request $request)
    {
        $this->validate($request, [
            'cat_id' => 'required|integer'
        ],[
            'cat_id.required' => 'kategori tidak boleh kosong',
            'cat_id.integer'  => 'kategori harus berupa angka'
        ]);

        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/images/imageslider', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }
        }

        $post = [
            'cat_id'    => $request->cat_id,
            'is_active' => !empty($request->is_active) ? 1 : 0,
            'image'     => !empty($files) ? $files[0]['images'] : null,
            'images'    => $files ?? NULL,
        ];

        Images::create($post);
        return redirect()->route('admin.images.imageslider')->with(['success' => sprintf('Imageslider Berhasil Disimpan.')]);
    }

    public function imageslider_category_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ],[
            'name.required' => 'Nama kategori tidak boleh kosong'
        ]);

        $post = [
            'name'      => $request->name,
            'is_active' => !empty($request->is_active) ? 1 : 0
        ];

        ImagesCategory::create($post);
        return redirect()->route('admin.images.imageslider_category')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->name)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Images $images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Images $images)
    {
        //
    }

    public function imageslider_edit($id)
    {
        $imageslider          = Images::with('imageslider_category')->findOrFail($id);
        $imageslider_category = ImagesCategory::orderBy('id', 'desc')->get();
        $data                 = [
            'title'       => 'Imageslider edit',
            'imageslider' => $imageslider,
            'category'    => $imageslider_category
        ];
        return view('admin.images.imageslider_edit', $data);
    }

    public function imageslider_category_edit($id)
    {
        $imageslider_category = ImagesCategory::findOrFail($id);
        $data                 = [
            'title' => 'Imageslider kategori edit',
            'item'  => $imageslider_category
        ];
        return view('admin.images.imageslider_category_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Images $images)
    {
        //
    }

    public function imageslider_update(Request $request, $id)
    {
        $this->validate($request, [
            'cat_id' => 'required|integer'
        ],[
            'cat_id.required' => 'kategori tidak boleh kosong',
            'cat_id.integer'  => 'kategori harus berupa angka'
        ]);

        $imageslider = Images::findOrFail($id);
        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/images/imageslider', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }

            if (!empty($imageslider->images)) {
                foreach ($imageslider->images as $image) {
                    //delete old image
                    Storage::delete('public/images/imageslider/'.$image['images']);
                }
            }
        }

        $post = [
            'cat_id'    => $request->cat_id,
            'is_active' => !empty($request->is_active) ? 1 : 0,
            'image'     => !empty($files) ? $files[0]['images'] : $imageslider->image,
            'images'    => $files ?? $imageslider->images,
        ];

        $imageslider->update($post);
        return redirect()->route('admin.images.imageslider')->with(['success' => sprintf('Imageslider Berhasil Diupdate.')]);
    }

    public function imageslider_category_update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ],[
            'name.required' => 'Nama kategori tidak boleh kosong'
        ]);

        $imageslider_category = ImagesCategory::findOrFail($id);
        $post = [
            'name'      => $request->name,
            'is_active' => !empty($request->is_active) ? 1 : 0
        ];

        $imageslider_category->update($post);
        return redirect()->route('admin.images.imageslider_category')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->name)]);
    }

    public function imageslider_category_update_active(Request $request, $id)
    {
        if (request()->ajax()) {
            $imageslider_category            = ImagesCategory::find($id);
            $imageslider_category->is_active = $request->is_checked;
            $text_active                     = empty($request->is_checked) ? 'menonaktifkan' : 'mengaktifkan';
            if (!$imageslider_category->update()) {
                return response()->json([
                    'message' => 'Gagal '.$text_active.' kategori '.$imageslider_category->name,
                ]);
            }
            return response()->json([
                    'message' => 'Berhasil '.$text_active.' kategori '.$imageslider_category->name,
            ]);
        }
    }

    public function imageslider_update_active(Request $request, $id)
    {
        if (request()->ajax()) {
            $images            = Images::find($id);
            $images->is_active = $request->is_checked;
            $text_active       = empty($request->is_checked) ? 'menonaktifkan' : 'mengaktifkan';
            if (!$images->update()) {
                return response()->json([
                    'message' => 'Gagal '.$text_active.' imageslider ',
                ]);
            }
            return response()->json([
                    'message' => 'Berhasil '.$text_active.' imageslider ',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function imageslider_destroy($id)
    {
        $imageslider = Images::findOrFail($id);

        if (!empty($imageslider->images)) {
            foreach ($imageslider->images as $image) {
                //delete old image
                Storage::delete('public/images/imageslider/'.$image['images']);
            }
        }

        $imageslider->delete();
        return redirect()->route('admin.images.imageslider')->with(['success' => sprintf('Imageslider Berhasil Dihapus.')]);
    }

    public function imageslider_category_destroy($id)
    {
        $imageslider_category = ImagesCategory::findOrFail($id);
        $imageslider_category->delete();
        return redirect()->route('admin.images.imageslider_category')->with(['success' => sprintf('%s Berhasil Dihapus.', $imageslider_category->name)]);
    }
}
