<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationalMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EducationalMaterialController extends Controller
{
    public function index()
    {
        $materials = EducationalMaterial::where('is_approved', true)->get();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:article,image,audio,video',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,mp3,mp4|max:20480', // Maksimum 20MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public/materials');
        }

        EducationalMaterial::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('materials.index')->with('success', 'Materi berhasil diupload dan menunggu approval.');
    }
}

