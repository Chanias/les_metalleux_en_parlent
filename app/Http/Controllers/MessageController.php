<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //afficher le formulaire avant validation -> methode get
    {
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
            'content' => 'required|min:25|max:500',
            'tags' => 'nullable|min:3|max:30',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // on donne un nom à l'image : timestamp en temps unix + extension
        $imageName = time() . '.' . $request->image->extension();

        //on déplace l'image dans public/images
        $request->image->move(public_path('images'), $imageName);

        $user = Auth::user();

        $message = new Message;

        $this->authorize('create', $message);

        $message->user_id = $user->id;
        $message->content = $request->input('content');
        $message->tags = $request->input('tags');
        $message->image = $imageName;
        $message->save();

        //AUTRE METHODE----------------------------------------------------------------------------------------------------------------------
        // Message::create([
        //     'user_id' => Auth::user()->id,
        //     'content' => $request['content'],
        //     'tags' => $request['tags'],
        // ]);

        return redirect()->route('home')->with('message', 'Le message a bien été enregistré...');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $this->authorize('update', $message);
        return view('user/modifMessage', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);
        $request->validate([
            'content' => 'required|min:25|max:1500',
            'tags' => 'nullable|min:3|max:25',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // on donne un nom à l'image : timestamp en temps unix + extension
        $imageName = time() . '.' . $request->image->extension();

        //on déplace l'image dans public/images
        $request->image->move(public_path('images'), $imageName);

        $message->content = $request['content'];
        $message->tags = $request['tags'];
        $message->image = $imageName;
        $message->save();

        return redirect()->route('home')->with('message', 'Le message a bien été modifié...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return redirect()->route('home')->with('message', 'Le message a bien été supprimé...');
    }



    public function search(Request $request)
    {
        $search = $request->input('search');

        $messages = Message::query()
            ->where('content', 'LIKE', "%{$search}%")
            ->orWhere('tags', 'LIKE', "%{$search}%")
            ->get();

        return view('user.search', compact('messages'));
    }
}
