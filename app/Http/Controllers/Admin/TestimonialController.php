<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonial = Testimonial::orderBy('id', 'desc')->paginate(10);
        $data = [
            'title'       => 'Testimonial',
            'testimonial' => $testimonial
        ];
        return view('admin.testimonial.testimonial', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Testimonial Baru'
        ];

        return view('admin.testimonial.testimonial_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required'
        ], [
            'name.required'        => 'Nama testimonial tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
        ]);

        $file = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if (!empty($file)) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                $file->storeAs('public/testimonial', $filename);
            }
        }

        $post = [
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => !empty($file) ? $filename : null,
        ];

        Testimonial::create($post);
        return redirect()->route('admin.testimonial')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->name)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $data        = [
            'title'       => 'Testimonial Edit',
            'testimonial' => $testimonial
        ];

        return view('admin.testimonial.testimonial_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required'
        ], [
            'name.required'        => 'Nama testimonial tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
        ]);


        $file        = '';
        $testimonial = Testimonial::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if (!empty($file)) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                $file->storeAs('public/testimonial', $filename);
                Storage::delete('public/testimonial/'.$testimonial['image']);
            }
        }

        $post        = [
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => !empty($file) ? $filename : $testimonial->image,
        ];

        $testimonial->update($post);
        return redirect()->route('admin.testimonial')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->name)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if (!empty($testimonial->image)) {
            Storage::delete('public/testimonial/'.$testimonial->image);
        }

        $testimonial->delete();
        return redirect()->route('admin.testimonial')->with(['success' => sprintf('%s Berhasil Dihapus.', $testimonial->name)]);
    }
}
