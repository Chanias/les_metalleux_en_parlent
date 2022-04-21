@extends('layouts/app')

@section('title')
Modifier mes informations
@endsection

@section('content')

<div class="container text-center" >
<h2>Modifier mes informations</h2>
<form class="section" action="{{route('update')}}" method="post">
@csrf
@method('PUT')
    

    <div class="field">
        <label class="label">Nouveau pseudo</label>
        <div class="control">
            <input class="input" type="text" name="pseudo" value="{{$user->pseudo}}">
        </div>
        @if($errors->has('pseudo'))
            <p class="help is-danger">{{ $errors->first('pseudo') }}</p>
        @endif
    </div>
    <div class="field">
        <div class="control">
            <button class="btn btn-success" type="submit">Modifier mon pseudo</button>
        </div>
    </div>
</form>

 <!-- PARTIE MODIFIER MOT DE PASSE -->

 <h3 class="mt-5 mb-5 fw-bold ">Modifier le mot de passe</h3>

<form method="POST" action="{{ route('modifiermotdepasse') }}">
    @csrf
    @method('PUT')
    <div>
        <label for="password" class="mt-3 fs-4">Mot de passe actuel : </label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="password" class="mt-3 fs-4">Nouveau mot de passe : </label>
        <input type="password" id="new_password" name="new_password">
    </div>
    <div>
        <label for=" password-confirm" class="mt-3 mb-5 fs-4">Confirmer mot de passe : </label>
        <input id="password-confirm" type="password" name="new_password_confirmation" required
            autocomplete="new-password">
    </div>
    <button type="submit" class="bouton mt-3 mb-5">
        {{ __('Modifier mot de passe') }}
    </button>
</form>
</div>
</div>

@endsection