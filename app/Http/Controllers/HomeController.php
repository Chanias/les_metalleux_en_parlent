<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('guest')->only('welcome');

    }


    public function welcome()
    {
        return view('welcome');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //On récupère tous les messages et leurs commentaires
        // via un EAGER LOADING
        $messages = Message::with('commentaires.user', 'user')->latest()->paginate(10);
        // on charge les commentaires associés aux messages
        //$messages->load('commentaires');

        // On transmet les Messages à la vue
        return view('home', compact('messages'));
    }
}
