<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Menu;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::orderBy('id', 'desc')->get();
        $data    = [
            'title' => 'Navbars',
            'menus' => $menu
        ];
        return view('admin.navbars', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Navbars Create',
        ];
        return view('admin.navbars_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'name'     => 'required',
                'route'    => 'required',
                'prefix'   => 'required',
                'is_admin' => 'required|in:0,1,2',
            ],
            [
                'name.required'     => 'Nama menu tidak boleh kosong',
                'route.required'    => 'Route tidak boleh kosong',
                'prefix.required'   => 'Prefix tidak boleh kosong',
                'is_admin.required' => 'silahkan pilih salah satu menu',

            ]
        );
        $post = [
            'name'     => $request->name,
            'route'    => $request->route,
            'prefix'   => $request->prefix,
            'is_admin' => $request->is_admin,
            'ordering' => Menu::select('ordering')->orderBy('ordering', 'desc')->first()->ordering + 1
        ];
        Menu::create($post);

        return redirect()->route('admin.navbars')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->name)]);
    }

    public function update_menu_active(Request $request, $id){
        if (request()->ajax()) {
            $menu            = Menu::find($id);
            $menu->is_active = $request->is_checked;
            if (!$menu->update()) {
                return response()->json([
                    'message' => 'error set active menu',
                ]);
            }
            return response()->json([
                'message' => 'success set active menu',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
