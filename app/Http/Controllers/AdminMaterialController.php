<?php

namespace App\Http\Controllers;

use App\Models\EducationalMaterial;
use Illuminate\Http\Request;

class AdminMaterialController extends Controller
{
    public function index()
    {
        $materials = EducationalMaterial::where('is_approved', false)->get();
        return view('admin.materials.index', compact('materials'));
    }

    public function approve($id)
    {
        $material = EducationalMaterial::findOrFail($id);
        $material->is_approved = true;
        $material->save();

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil disetujui.');
    }
}
