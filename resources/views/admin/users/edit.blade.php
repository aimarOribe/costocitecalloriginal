@extends('layouts.template')

@section('title','Editar Rol Usuario')

@section('css')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
@endsection

@section('content')
    <div class="margen-principal">
        <h1>Assign a Role</h1>

        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{session('info')}}</strong>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <p class="h5">Name:</p>
                <p class="form-control">{{$user->name}}</p>
                <h2 class="h5">List of Roles:</h2>
                {!! Form::model($user, ['route' => ['admin.users.update',$user], 'method' => 'put']) !!}
                    @foreach ($roles as $role)
                        <div>
                            <label>
                                {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                    {!! Form::submit('Asignar rol', ['class' => 'btn btn-success mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endsection