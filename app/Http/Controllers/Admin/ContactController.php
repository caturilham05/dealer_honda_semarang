<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'title'    => 'Kontak',
            'contacts' => Contacts::orderBy('id', 'desc')->paginate(10)
        ];
        return view('admin.contact.contact', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Kontak Baru'
        ];

        return view('admin.contact.contact_create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'whatsapp_number' => 'required'
        ],[
            'whatsapp_number.required' => 'Nomor HP tidak boleh kosong'
        ]);

        if (preg_match('~^0~is', $request->whatsapp_number))
        {
            $request->whatsapp_number = preg_replace('~^0~is', '62', $request->whatsapp_number);
        }

        $post = [
            'whatsapp_number' => $request->whatsapp_number,
            'address'         => $request->address,
            'description'     => $request->description,
            'text_message'    => $request->text_message,
            'url_google_maps' => $request->url_google_maps,
            'is_active'       => !empty($request->is_active) ? 1 : 0
        ];

        Contacts::create($post);
        return redirect()->route('admin.contact')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->whatsapp_number)]);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Kontak Edit',
            'item'  => Contacts::findOrFail($id)
        ];
        return view('admin.contact.contact_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'whatsapp_number' => 'required'
        ],[
            'whatsapp_number.required' => 'Nomor HP tidak boleh kosong'
        ]);

        if (preg_match('~^0~is', $request->whatsapp_number))
        {
            $request->whatsapp_number = preg_replace('~^0~is', '62', $request->whatsapp_number);
        }

        $contact = Contacts::findOrFail($id);
        $post = [
            'whatsapp_number' => $request->whatsapp_number,
            'address'         => $request->address,
            'description'     => $request->description,
            'text_message'    => $request->text_message,
            'url_google_maps' => $request->url_google_maps,
            'is_active'       => !empty($request->is_active) ? 1 : 0
        ];

        $contact->update($post);
        return redirect()->route('admin.contact')->with(['success' => sprintf('%s Berhasil Diupdate.', $request->whatsapp_number)]);
    }

    public function update_active(Request $request, $id)
    {
        if (request()->ajax()) {
            $contact            = Contacts::find($id);
            $contact->is_active = $request->is_checked;
            $text_active        = empty($request->is_checked) ? 'menonaktifkan' : 'mengaktifkan';
            if (!$contact->update()) {
                return response()->json([
                    'message' => 'Gagal '.$text_active.' Kontak '.$contact->whatsapp_number,
                ]);
            }
            return response()->json([
                    'message' => 'Berhasil '.$text_active.' Kontak '.$contact->whatsapp_number,
            ]);
        }
    }

    public function destroy($id)
    {
        $contact = Contacts::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact')->with(['success' => sprintf('%s Berhasil Dihapus.', $contact->whatsapp_number)]);
    }
}
