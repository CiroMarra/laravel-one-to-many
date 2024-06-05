@extends('layouts.admin')

@section('content')
    <div>
        <h2>Nome Progetto: {{ $project->name }}</h2>
    </div>
    @if ($project->cover_image)
        <div>
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="card-img" style="max-width: 340px;">
        </div>
    @endif

    <div>
        <strong>Created at</strong>: {{ $project->created_at }}
    </div>
    <div class="my-3">
        
        <div class="my-1">
            <strong>Summary</strong>: 
        </div>
        {{ $project->summary }}
    </div>
    <div class="my-5">
        <small><strong>Last update</strong>: {{ $project->updated_at }}</small>
    </div>

    @if ($project->content)
        <p class="mt-5">{{ $project->content }}</p>
    @endif
@endsection