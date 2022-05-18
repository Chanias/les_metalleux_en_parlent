@extends('layouts/app')

@section('title')
    Mon compte
@endsection

@section('content')
    <div class="container" id="buttons">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Mes informations</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center">
                <a href="/modifCompte" class="btn btn-success">Modifier mes informations</a>
            </div>

            <div class="col-md-6 text-center">
                <form class="section" action="{{ route('supprimercompte') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="supprimer">
            </div>
        </div>
    </div>
    <hr>
    <div class="container" id="infos">
        <div class="row">
            <div class="col-md-12 text-center">
                @if ($user->image)
                    <img src="{{ asset("images/$user->image") }}" alt="photo_profil">
                @else
                    <img src="{{ asset('images/user.jpg') }}" alt="photo_profil">
                @endif
            </div>
        </div>
    </div>










    <div class="card text-center">
        <div class="card-body">

            <div class="col-md-6 ">

            </div>

            <div class="col-md-6">

            </div>

            </form>
        </div>



        <p>votre pseudo : {{ $user->pseudo }}</p>
        <p> votre email : {{ $user->email }}</p>

    </div>
@endsection
