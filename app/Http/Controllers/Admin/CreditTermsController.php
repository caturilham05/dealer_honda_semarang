<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Tenor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreditTermsController extends Controller
{
    protected $credits;
    protected $tenors;

    public function __construct(Credit $credits, Tenor $tenors)
    {
        $this->credits   = $credits->get();
        $this->tenors    = $tenors->get();
        $this->data_view = [
            'credits' => $this->credits,
            'tenors'  => $this->tenors
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data_view['title'] = 'Syarat Kredit';
        return view('admin.credits.credit_terms', $this->data_view);
    }

    public function tenor()
    {
        $this->data_view['title'] = 'Tenor';
        return view('admin.credits.tenor', $this->data_view);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function credit_terms_create()
    {
        $data = [
            'title' => 'Syarat Kredit Baru'
        ];

        return view('admin.credits.credit_terms_create', $data);
    }

    public function tenor_create()
    {
        $data = [
            'title' => 'Tenor Baru'
        ];

        return view('admin.credits.tenor_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function credit_terms_store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ],[
            'description.required' => 'deskripsi tidak boleh kosong'
        ]);

        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/credit_terms', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }
        }

        $post = [
            'description' => $request->description,
            'is_active'   => !empty($request->is_active) ? 1 : 0,
            'image'       => !empty($files) ? $files[0]['images'] : null,
            'images'      => $files ?? NULL,
        ];

        Credit::create($post);
        return redirect()->route('admin.credit_terms')->with(['success' => sprintf('Syarat Kredit Berhasil Disimpan.')]);
    }

    public function tenor_store(Request $request)
    {
        $this->validate($request, [
            'tenor' => 'required',
            'unit'  => 'required'
        ],[
            'tenor.required' => 'tenor tidak boleh kosong',
            'unit.required'  => 'jangka waktu tenor tidak boleh kosong'
        ]);

        $post = [
            'tenor'     => $request->tenor,
            'unit'      => $request->unit,
            'is_active' => !empty($request->is_active) ? 1 : 0,
        ];

        Tenor::create($post);
        return redirect()->route('admin.tenor')->with(['success' => sprintf('Tenor Berhasil Disimpan.')]);
    }

    /**
     * Display the specified resource.
     */
    public function credit_terms_show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function credit_terms_edit($id)
    {
        $this->data_view['item']  = Credit::findOrFail($id);
        $this->data_view['title'] = 'Syarat Kredit Edit';

        return view('admin.credits.credit_terms_edit', $this->data_view);
    }

    public function tenor_edit($id)
    {
        $this->data_view['item']  = Tenor::findOrFail($id);
        $this->data_view['title'] = 'Syarat Kredit Edit';

        return view('admin.credits.tenor_edit', $this->data_view);
    }

    /**
     * Update the specified resource in storage.
     */
    public function credit_terms_update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required'
        ],[
            'description.required' => 'deskripsi tidak boleh kosong'
        ]);

        $credit = Credit::findOrFail($id);
        if ($request->hasFile('images'))
        {
            $files = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->storeAs('public/credit_terms', $filename);
                    $files[] = [
                        'images' => $filename,
                    ];
                }
            }

            if (!empty($credit->images)) {
                foreach ($credit->images as $image) {
                    //delete old image
                    Storage::delete('public/credit_terms/'.$image['images']);
                }
            }
        }

        $post = [
            'description' => $request->description,
            'is_active'   => !empty($request->is_active) ? 1 : 0,
            'image'       => !empty($files) ? $files[0]['images'] : $credit->image,
            'images'      => $files ?? $credit->images,
        ];

        $credit->update($post);
        return redirect()->route('admin.credit_terms')->with(['success' => sprintf('Syarat Kredit Berhasil Diupdate.')]);
    }

    public function credit_terms_update_active(Request $request, $id){
        if (request()->ajax()) {
            $credit            = Credit::findOrFail($id);
            $credit->is_active = $request->is_checked;
            $text_active        = empty($request->is_checked) ? 'menonaktifkan' : 'mengaktifkan';
            if (!$credit->update()) {
                return response()->json([
                    'message' => 'Gagal '.$text_active.' Syarat Kredit',
                ]);
            }
            return response()->json([
                    'message' => 'Berhasil '.$text_active.' Syarat Kredit',
            ]);
        }
    }

    public function tenor_update_active(Request $request, $id){
        if (request()->ajax()) {
            $tenor            = Tenor::findOrFail($id);
            $tenor->is_active = $request->is_checked;
            $text_active        = empty($request->is_checked) ? 'menonaktifkan' : 'mengaktifkan';
            if (!$tenor->update()) {
                return response()->json([
                    'message' => 'Gagal '.$text_active.' Tenor',
                ]);
            }
            return response()->json([
                    'message' => 'Berhasil '.$text_active.' Tenor',
            ]);
        }
    }


    public function tenor_update(Request $request, $id)
    {
        $this->validate($request, [
            'tenor' => 'required',
            'unit'  => 'required'
        ],[
            'tenor.required' => 'tenor tidak boleh kosong',
            'unit.required'  => 'jangka waktu tenor tidak boleh kosong'
        ]);

        $tenor = Tenor::findOrFail($id);
        $post  = [
            'tenor'     => $request->tenor,
            'unit'      => $request->unit,
            'is_active' => !empty($request->is_active) ? 1 : 0,
        ];
        $tenor->update($post);
        return redirect()->route('admin.tenor')->with(['success' => sprintf('Tenor Berhasil Diupdate.')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function credit_terms_destroy($id)
    {
        $credit = Credit::findOrFail($id);

        if (!empty($credit->images)) {
            foreach ($credit->images as $image) {
                //delete old image
                Storage::delete('public/credit_terms/'.$image['images']);
            }
        }

        $credit->delete();
        return redirect()->route('admin.credit_terms')->with(['success' => sprintf('Syarat Kredit Berhasil Dihapus.')]);
    }

    public function tenor_destroy($id)
    {
        $tenor = Tenor::findOrFail($id);
        $tenor->delete();
        return redirect()->route('admin.tenor')->with(['success' => sprintf('Tenor Berhasil Dihapus.')]);
    }
}
