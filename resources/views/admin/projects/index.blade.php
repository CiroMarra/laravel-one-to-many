@extends('layouts.admin')

@section('content')
    <h1>Tutti i progetti</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Client</th>
                <th>Slug</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->client_name }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->created_at }}</td>

                    <td>
                        <div>
                            <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">View</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}">Edit</a>
                        </div>
                        <div>
                            <form action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection