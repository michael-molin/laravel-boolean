@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">photos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <h2>Photos</h2>
                    </div>
                    <div class="offset-3 col-3">
                        <a href="{{route('admin.photos.create')}}">Carica una fotografia</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead-dark ">
                        <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{$photo->id}}</td>
                                <td>{{$photo->name}}</td>
                                <td><a class="btn btn-info" href="{{route('admin.photos.edit' , $photo->id)}}">Modifica</a></td>
                                <td>
                                    <form action="{{route('admin.photos.destroy' , $photo->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Elimina">
                                    </form>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <img src="{{asset('storage/'. $photo->path)}}" alt="">
            </div>
        </div>
    </div>
@endsection
