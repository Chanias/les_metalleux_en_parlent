@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')
    <div class="container header">
        <div class="row mt-5">
            <div class="row mt-5 text-center">
                <div class="col-12">
                    <h1>Bienvenue sur le site des métalleux</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="form-message">
        <div class="row">
            <div class="col-md-12 text-center">
                <form action="{{ route('message.store') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="field">
                        <label class="label">Message</label>
                        <div class="control">
                            <textarea class="textarea" name="content" placeholder="Qu'avez-vous à dire ?"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <label for="image" class="fs-4 mb-3 mt-3">Image : </label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-6 mx-auto">
                        <div class="row">
                            <label for="tags" class="mt-3 mb-3 fs-4">Tu peux ajouter le # que tu veux : </label>
                        </div>
                        <input type="text" id="tags" name="tags" size="30">
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <button class="btn btn-primary" type="submit">Publier</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- On parcourt la collection de messages -->

    <h2>Les derniers messages</h2>
    @foreach ($messages as $message)
        <div class="container">

            <div class="row text-center" id="corps-body">
                <div class="col-md-12">
                    <p>Posté le :{{ $message->created_at }}</p>
                    <p>{{ $message->content }}</p>
                    <p>{{ $message->tags }}</p>
                </div>

                <div class="col-12">
                    @if ($message->image)
                        <img src="{{ asset("images/$message->image") }}" alt="image">
                    @endif
                </div>




                @can('update', $message)
                    <!--LIEN POUR ALLER SUR LA VIEW MODIFIER LE MESSAGE-->
                    <form method="put" action="{{ route('message.edit', $message) }}">
                        <input type="submit" class="btn btn-success" value="Modifier le message">
                    </form>
                @endcan



                @can('delete', $message)
                    <!--SUPPRIMER LE MESSAGE-->
                    <form method="POST" action="{{ route('message.destroy', $message) }}">
                        <!-- CSRF token -->
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger" value="Supprimer le message">

                    </form>
                @endcan
            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <form action="{{ route('commentaire.store') }}" method="post">
                        @csrf

                        <div class="field">
                            <h2>Un commentaire ?</h2>
                            <div class="control">
                                <textarea class="textarea" name="content" placeholder="Un commentaire ? Lâchez vous..."></textarea>
                            </div>
                            @if ($errors->has('commentaire'))
                                <p class="help is-danger">{{ $errors->first('commentaire') }}</p>
                            @endif
                        </div>
                        <div class="col-6 mx-auto">
                            <div class="row">
                                <label for="tags" class="mt-3 mb-3 fs-4">Tu peux ajouter le # que tu veux : </label>
                            </div>
                            <input type="text" id="tags" name="tags" size="30">
                        </div>
                        <br>
                        <div class="field">
                            <div class="control">
                                <input type="hidden" name="message_id" value="{{ $message->id }}">
                                <button class="btn btn-primary" type="submit">Commenter</button>

                            </div>
                        </div>
                    </form>

                    <!--AFFICHER LES COMMENTAIRES SUR CHAQUE MESSAGES-->
                    @foreach ($message->commentaires as $commentaire)
                        <div class="commentaire">
                            <p>{{ $commentaire->user->pseudo }}</p>
                            <p>{{ $commentaire->content }}</p>
                            <div class="col-12">
                                @if ($commentaire->image)
                                    <img src="{{ asset("images/$commentaire->image") }}" alt="image">
                                @endif
                            </div>


                            @can('update', $commentaire)
                                <!--LIEN POUR ALLER SUR LA VIEW MODIFIER LE COMMENTAIRE-->
                                <form method="put" action="{{ route('commentaire.edit', $commentaire) }}">
                                    <input type="submit" class="btn btn-success" value="Modifier le commentaire">
                                </form>
                            @endcan

                            @can('delete', $commentaire)
                                <!--SUPPRIMER LE COMMENTAIRE-->
                                <form method="POST" action="{{ route('commentaire.destroy', $commentaire) }}">
                                    <!-- CSRF token -->
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="btn btn-danger" value="Supprimer le commentaire">
                                </form>
                            @endcan
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    @endforeach

    </div>
    </div>

    <div>
        {{ $messages->links() }}
    </div>

    </div>
@endsection
