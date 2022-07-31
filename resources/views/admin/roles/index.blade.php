@extends('layouts.template')

@section('title','Roles')

@section('css')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
@endsection

@section('content')
    <div class="margen-principal">
        <h1>List of Roles</h1>
        @can('admin.roles.create')
            <a class="btn btn-secondary mb-2" href="{{route('admin.roles.create')}}">Add Role</a>
        @endcan
        @if (session('info'))
            <div class="alert alert-success">
                {{session('info')}}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Role</th>
                            @can('admin.roles.edit')
                                <th></th>
                            @endcan
                            @can('admin.roles.destroy')
                                <th></th>
                            @endcan 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                @can('admin.roles.edit')
                                    <td width="10px">
                                        <a href="{{route('admin.roles.edit',$role)}}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                @endcan
                                @can('admin.roles.destroy')
                                    <td width="10px">
                                        <form action="{{route('admin.roles.destroy',$role)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                @endcan 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endsection