<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Hash;
use Str;

use Illuminate\Validation\Rules\Password;
use App\Models\Message;
use App\Models\User;

class UserController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function compte()
    {
        $user = Auth()->user();
        return view('user.compte', ['user' => $user]); // nom variable dans vue => valeur
        // return view('user.compte', compact('user')); // nom variable dans vue => valeur

    }


    public function modifCompte()
    {
        $user = Auth()->user();
        return view('user.modifCompte', compact('user'));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'pseudo' =>  'required|min:2|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        // on donne un nom à l'image : timestamp en temps unix + extension
        $imageName = time() . '.' . $request->image->extension();

        //on déplace l'image dans public/images
        $request->image->move(public_path('images'), $imageName);
        $user = Auth::user();

        $user->pseudo = $request->input('pseudo');
        $user->image = $imageName;

        $user->save();
        return redirect('/compte')->with('message', 'Le pseudo a bien été modifié');
    }
    public function modifiermotdepasse(Request $request)
    {
        $request->validate([
            // 'token' => 'required',
            'password' => 'required',    //mot de passe actuel
            'new_password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()]
        ]);

        $user = Auth::user();
        //  $user->password = $request['token'];
        if (!Hash::check($request['password'], $user->password)) { // si mdp et different du mdp acuel alors erreur sinon on continue dans le else

            return redirect()->back()->withErrors(['erreur' => 'erreur mot de passe actuel']);
        } else {

            if ($request['password'] == $request['new_password']) { // si mdp et pareille que le nouveau mdp  alors erreur sinon on continue dans le else

                return redirect()->back()->withErrors(['erreur' => 'le mot de passe actuel et identique au nouveau mot de passe']);
            } else

                $user->password = Hash::make($request['new_password']);
            $user->save();
            // ->setRememberToken(Str::random(60));
            return redirect()->route('compte')->with('message', 'Le mot de passe a bien été modifié');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();
        return redirect()->route('home')->with('message', 'Le compte a bien été supprimé');
    }
}
