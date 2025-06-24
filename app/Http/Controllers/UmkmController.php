<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;

class UmkmController extends Controller
{
    public function show($id)
    {
        $umkm = Umkm::with(['kategori', 'kabkota', 'user', 'pembina'])
            ->findOrFail($id);

        return view('umkm.show', compact('umkm'));
    }
}
