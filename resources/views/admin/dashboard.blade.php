@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div>
                        Benvenuto {{ $user->name }}.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection