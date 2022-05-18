@extends("layouts.app")
@section('title', 'Editer un commentaire')
@section('content')

    <h1>Modifier un commentaire</h1>

    <!-- Si nous avons un message -->

    <div class="container">

        <div class="row">
            <form method="POST" action="{{ route('commentaire.update', $commentaire) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="field">
                    <label class="label">Nouveau texte ?</label>
                    <div class="control">
                        <input class="input" id="content" type="text" name="content"
                            value="{{ $commentaire->content }}">
                    </div>
                    @if ($errors->has('content'))
                        <p class="help is-danger">{{ $errors->first('content') }}</p>
                    @endif
                </div>
                <div class="field">
                    <label class="label">Nouveaux tags ?</label>
                    <div class="control">
                        <input class="input" id="tags" type="text" name="tags" value="{{ $commentaire->tags }}">
                    </div>
                    @if ($errors->has('tags'))
                        <p class="help is-danger">{{ $errors->first('tags') }}</p>
                    @endif
                </div>



                <div class="row text-center" id="image">
                    <div class="col-md-6 mx-auto">
                        <label for="image" class="fs-4 mt-3">Image : </label>
                        <input type="file" name="image" class="form-control ">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" class="bouton mt-3 mb-3">
                            {{ __('Modifier commentaire') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>









@endsection
