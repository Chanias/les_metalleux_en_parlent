<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Auth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required|min:3|max:500',
            'tags' => 'nullable|min:3|max:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // on donne un nom à l'image : timestamp en temps unix + extension
        $imageName = time() . '.' . $request->image->extension();

        //on déplace l'image dans public/images
        $request->image->move(public_path('images'), $imageName);
        $commentaire = new Commentaire; // instancier le commentaire vide

        $this->authorize('create', $commentaire);
        // creation du commentaire et des valeurs de ses propriétés

        $commentaire->content = $request->input('content');
        $commentaire->tags = $request->input('tags');
        $commentaire->image = $imageName;
        $commentaire->user_id = Auth::user()->id;
        $commentaire->message_id = $request->input('message_id');
        $commentaire->save();

        //Commentaire::create([
        //'message_id'=> $request['message_id'],
        // 'content' => $request['content'],
        //'tags' => $request['tags'],

        return redirect()->route('home')->with('message', 'Votre commentaire a bien été enregistré...');
    }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        $this->authorize('update', $commentaire);
        return view('user/modifCommentaire', compact('commentaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        $this->authorize('update', $commentaire);

        $request->validate([
            'content' => 'required|min:3|max:1500',
            'tags' => 'nullable|min:3|max:25',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request['image']) {
            // on donne un nom à l'image : timestamp en temps unix + extension
            $imageName = time() . '.' . $request->image->extension();
            //on déplace l'image dans public/images
            $request->image->move(public_path('images'), $imageName);
            $commentaire->image = $imageName;
        }

        $commentaire->content = $request['content'];
        $commentaire->tags = $request['tags'];

        $commentaire->update();

        return redirect()->route('home')->with('message', 'Votre commentaire a bien été modifié...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        $this->authorize('delete', $commentaire);
        $commentaire->delete();
        return redirect()->route('home')->with('message', 'Votre commentaire a bien été supprimé...');
    }
}
