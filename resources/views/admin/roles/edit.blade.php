@extends('layouts.template')

@section('title','Roles')

@section('css')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
@endsection

@section('content')
    <div class="margen-principal">
        <h1>Edit Role</h1>
        @if (session('info'))
            <div class="alert alert-success">
                {{session('info')}}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                {!! Form::model($role, ['route'=>['admin.roles.update',$role],'method'=>'put']) !!}
                @include('admin.roles.partials.form')
                {!! Form::submit('Update Role', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endsection