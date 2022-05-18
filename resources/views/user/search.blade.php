@extends('layouts/app')

@section('title')
    Resultat recherche
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>RESULTAT DE LA RECHERCHE</h2>
            </div>
        </div>
        <div class="row">
            @csrf
            <form action="{{ route('search') }}" method="get">
                @if ($messages->isNotEmpty())
                    @foreach ($messages as $message)
                        <div class="message-list">
                            <p>{{ $message->content }}</p>
                            <p>{{ $message->tags }}</p>
                        </div>
                    @endforeach
                @else
                    <div>
                        <h2>No posts found</h2>
                    </div>
                @endif
        </div>
    </div>





@endsection
