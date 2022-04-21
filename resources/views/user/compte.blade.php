@extends('layouts/app')

@section('title')
Mon compte
@endsection

@section('content')
    
<div class="card text-center">
  <div class="card-body">
    <h2 class="card-title">Mes informations</h2>
    <a href="/modifCompte" class="btn btn-success">Modifier mes informations</a>
<a href="#" class="btn btn-danger">Supprimer mon compte</a>
<div class="col-md-12 text-center">
                    <img src="{{asset("images/user.jpg")}}" alt="photo_profil">
                </div>
    <p>votre pseudo : {{$user->pseudo}}</p>
       <p> votre email :  {{$user->email}}</p>
 
  
</div>
</div>
@endsection