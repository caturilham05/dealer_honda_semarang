<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use App\Models\Content;

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

    public function create()
    {
        $data = [
            'title' => 'Content Beranda',
        ];

        return view('admin.content.dashboard_content_create', $data);
    }
}
