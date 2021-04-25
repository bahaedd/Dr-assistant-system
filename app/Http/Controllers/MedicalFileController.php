<?php

namespace App\Http\Controllers;

use App\Models\Medical_file;
use Illuminate\Http\Request;

class MedicalFileController extends Controller
{
    public function add_file(Request $request)
    {
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('medical_files', $fileName, 'public');
        $fileStore = '/storage/' . $filePath;
        Medical_file::create(
            [
                'patient_id'=> $request->patient_id,
                'file'=> $fileStore
            ]
        );

        return redirect()->back()->with('success', 'le dossier medicale ajouté avec succès');
    }

    public function update_file(Request $request)
    {
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('medical_files', $fileName, 'public');
        $fileStore = '/storage/' . $filePath;
        Medical_file::where('patient_id', $request->patient_id)->update(
            [
                'file'=> $fileStore
            ]
        );

        return redirect()->back()->with('success', 'le dossier medicale ajouté avec succès');
    }
}
