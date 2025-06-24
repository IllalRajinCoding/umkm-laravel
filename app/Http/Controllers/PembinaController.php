<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    public function index()
    {
        $pembinas = Pembina::with('umkm')->paginate(9);
        return view('pembina.index', compact('pembinas'));
    }

    /**
     * Display a specific pembina's details
     */
    public function show($id)
    {
        $pembina = Pembina::with('umkm')->findOrFail($id);
        return view('pembina.show', compact('pembina'));
    }
}
