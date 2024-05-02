<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use App\Models\Content;
use App\Models\ContentType;

class DashboardController extends Controller
{
    public function index()
    {
        $content = Content::with(['content_type'])->orderBy('id', 'desc')->paginate(10);
        $data = [
            'title'    => 'Beranda',
            'contents' => $content
        ];

        return view('admin.dashboard', $data);
    }

    public function home()
    {
        return view('public.layout.public');
    }

    public function create()
    {
        $content_type = ContentType::where('is_active', 1)->orderBy('id', 'desc')->get();
        $data = [
            'title'         => 'Content Beranda',
            'content_types' => $content_type
        ];

        return view('admin.content.dashboard_content_create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
                'content_type_id' => 'required|integer',
                'title'           => 'required',
                'content'         => 'required',
            ],
            [
                'title.required'           => 'Judul konten tidak boleh kosong',
                'content_type_id.required' => 'Tipe konten tidak boleh kosong',
                'content_type_id.integer'  => 'Tipe konten harus berupa angka',
                'content.required'         => 'Konten tidak boleh kosong',
            ]
        );

        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/contents', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }
        }

        $content = Content::select('ordering')->orderBy('ordering', 'desc')->first();
        $post = [
            'content_type_id' => $request->content_type_id,
            'title'           => $request->title,
            'intro'           => $request->intro,
            'keyword'         => $request->keyword,
            'tags'            => $request->tags,
            'content'         => $request->content,
            'is_active'       => !empty($request->is_active) ? 1 : 0,
            'image'           => !empty($files) ? $files[0]['images'] : null,
            'images'          => $files ?? NULL,
            'ordering'        => empty($content) ? 1 : Content::increment('ordering', 1)
        ];

        Content::create($post);
        return redirect()->route('admin.dashboard')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->title)]);
    }

    public function update_content_active(Request $request, $id)
    {
        if (request()->ajax()) {
            $content            = Content::find($id);
            $content->is_active = $request->is_checked;
            if (!$content->update()) {
                return response()->json([
                    'message' => 'Gagal mengaktifkan konten '.$content->title,
                ]);
            }
            return response()->json([
                'message' => 'Berhasil mengaktifkan konten '.$content->title,
            ]);
        }
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);

        if (!empty($content->images)) {
            foreach ($content->images as $image) {
                //delete old image
                Storage::delete('public/contents/'.$image['images']);
            }
        }

        $content->delete();
        return redirect()->route('admin.dashboard')->with(['success' => sprintf('%s Berhasil Dihapus.', $content->title)]);
    }

    public function edit($id)
    {
        $content      = Content::with(['content_type'])->findOrFail($id);
        $content_type = ContentType::get();
        $data         = [
            'title'         => 'Edit Konten',
            'content'       => $content,
            'content_types' => $content_type
        ];

        return view('admin.content.dashboard_content_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
                'content_type_id' => 'required|integer',
                'title'           => 'required',
                'content'         => 'required',
            ],
            [
                'title.required'           => 'Judul konten tidak boleh kosong',
                'content_type_id.required' => 'Tipe konten tidak boleh kosong',
                'content_type_id.integer'  => 'Tipe konten harus berupa angka',
                'content.required'         => 'Konten tidak boleh kosong',
            ]
        );

        $content = Content::findOrFail($id);
        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/contents', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }

            if (!empty($content->images)) {
                foreach ($content->images as $image) {
                    //delete old image
                    Storage::delete('public/contents/'.$image['images']);
                }
            }
        }

        $post = [
            'content_type_id' => $request->content_type_id,
            'title'           => $request->title,
            'intro'           => $request->intro,
            'keyword'         => $request->keyword,
            'tags'            => $request->tags,
            'content'         => $request->content,
            'is_active'       => !empty($request->is_active) ? 1 : 0,
            'image'           => !empty($files) ? $files[0]['images'] : $content->image,
            'images'          => $files ?? $content->images,
            // 'ordering'     => empty($content) ? 1 : Content::increment('ordering', 1)
        ];

        $content->update($post);
        return redirect()->route('admin.dashboard')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->title)]);
    }
}
