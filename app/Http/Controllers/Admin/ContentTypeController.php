<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentType;
use Illuminate\Http\Request;

class ContentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content_type = ContentType::orderBy('id', 'desc')->paginate(10);
        $data = [
            'title'         => 'Tipe Konten',
            'content_types' => $content_type,
        ];

        return view('admin.content.content_type', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tipe Konten Baru',
        ];

        return view('admin.content.content_type_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'title' => 'required',
            ],
            [
                'title.required' => 'Nama tipe konten tidak boleh kosong',
            ]
        );

        $post = [
            'title'     => $request->title,
            'is_active' => !empty($request->is_active) ? 1 : 0,
        ];

        ContentType::create($post);
        return redirect()->route('admin.content_type')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->title)]);
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContentType $contentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContentType $contentType, $id)
    {
        $data = [
            'title' => 'Edit Tipe Konten',
            'item'  => $contentType->findOrFail($id)
        ];

        return view('admin.content.content_type_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContentType $contentType, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $post = [
            'title'     => $request->title,
            'is_active' => !empty($request->is_active) ? 1 : 0
        ];
        $content_type = $contentType->findOrFail($id);
        $content_type->update($post);
        return redirect()->route('admin.content_type')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->title)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContentType $contentType, $id)
    {
        $content_type = $contentType->findOrFail($id);
        $content_type->delete();
        return redirect()->route('admin.content_type')->with(['success' => sprintf('%s Berhasil Dihapus.', $content_type->title)]);
    }

    public function update_content_type_active(Request $request, $id)
    {
        if (request()->ajax()) {
            $content_type            = ContentType::find($id);
            $content_type->is_active = $request->is_checked;
            if (!$content_type->update()) {
                return response()->json([
                    'message' => 'Gagal mengaktifkan konten tipe '.$request->name,
                ]);
            }
            return response()->json([
                'message' => 'Berhasil mengaktifkan konten tipe '.$request->name,
            ]);
        }
    }
}
