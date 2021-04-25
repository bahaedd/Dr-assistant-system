<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class ProfileController extends Controller
{
    /**
     * Display the profile view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Display the profile view.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPassword()
    {
        return view('password');
    }

    /**
     * Update the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([

            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],

        ]);

        User::find(auth()->user()->id)->update(
            ['password'=> Hash::make($request->new_password)],
        );

        return redirect()->back()->with('message', 'Mot de passe mis à jour avec succès');
    }
    /**
     * Update the profile.
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->image){
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('profile', $fileName, 'public');
            $fileStore = '/storage/' . $filePath;
            User::where('id', $id)->update(
                ['image'=> $fileStore],
            );
        }
        User::where('id', $id)->update(
            ['name'=> $request->name,
            'email'=> $request->email,
            'bio'=> $request->bio]
        );

        return redirect()->back()->with('message', 'Le profile mis à jour avec succès');
    }
}
