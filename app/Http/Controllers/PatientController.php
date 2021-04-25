<?php

namespace App\Http\Controllers;
use App\Models\Medical_file;
use App\Models\Patient;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('patients', $fileName, 'public');
        $fileStore = '/storage/' . $filePath;
        $patient = Patient::create(
            [
                'name'=> $request->name,
                'email'=> $request->email,
                'gender'=> $request->gender,
                'phone'=> $request->phone,
                'adress'=> $request->adress,
                'image'=> $fileStore
            ]
        );

        if($patient) {
            Medical_file::create([
                'patient_id' => $patient->id,
                'file' => '/storage/medical_files/dossier.jpg'
            ]);
        }

        return redirect()->back()->with('success', 'Patient ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->file('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('patients', $fileName, 'public');
            $fileStore = '/storage/' . $filePath;
            Patient::where('id', $id)->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'adress' => $request->adress,
                    'image' => $fileStore
                ]
            );
        }else {
            Patient::where('id', $id)->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'adress' => $request->adress
                ]
            );
        }

        return redirect()->back()->with('success', 'les informations de patient mis a jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $file = Medical_file::find($patient->id);
        unlink(public_path() . $patient->image);
        if($patient->delete()){
            $file->delete();
            return redirect()->back()->with('success', 'Patient supprimé avec succès');
        }else {
            return redirect()->back()->with('error', 'Quelque chose s\'est mal passé. réessayer');
        }
    }
}
