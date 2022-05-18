@extends("layouts.app")
@section('title', 'Editer un message')
@section('content')


    <div class="Container">
        <div class="row text-center md-6 mx-auto">
            <div class="col-md-12">
                <h2>Modifier un message</h2>
            </div>
        </div>


        <!-- Si nous avons un message -->
        @if (isset($message))
            <form method="POST" action="{{ route('message.update', $message) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row text-center">
                    <div class="field">
                        <div class="col-md-6 mx-auto">
                            <label for="label" class="mt-3 fs-4">Nouveau texte :</label>
                            <div class="control">
                                <input class="input" id="content" type="text" name="content"
                                    value="{{ $message->content }}">
                            </div>
                            @if ($errors->has('content'))
                                <p class="help is-danger">{{ $errors->first('content') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="field">
                        <div class="col-md-6 mx-auto">
                            <label for="label" class="mt-3 fs-4">Nouveaux tags ?</label>
                            <div class="control">
                                <input class="input" id="tags" type="text" name="tags"
                                    value="{{ $message->tags }}">
                            </div>
                            @if ($errors->has('tags'))
                                <p class="help is-danger">{{ $errors->first('tags') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row text-center" id="image">
                    <div class="col-md-6 mx-auto">
                        <label for="image" class="fs-4 mt-3">Image : </label>
                        <input type="file" name="image" class="form-control ">
                    </div>
                </div>

                <div class="field text-center">
                    <div class="control">
                        <button type="submit" class="bouton mt-3 mb-3">
                            {{ __('Modifier message') }}
                        </button>
                    </div>
                </div>
            </form>
         
    </div>

@endsection
