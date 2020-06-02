@php
// utilizzo i dati usati durante la lezione
$pages = [
  [
    'id' => 1,
    'title' => 'lorem ipsum dolor sit',
    'category' => 1,
    'tags' => [
      1,
      3,
      5
    ],
  ],
  [
    'id' => 2,
    'title' => 'Titolo lorem ipsum dolor sit',
    'category' => 1,
    'tags' => [
      4,
      6,
      8
    ],
  ],
  [
    'id' => 3,
    'title' => 'Tre lorem ipsum dolor sit',
    'category' => 2,
    'tags' => [
      1,
      3,
      5
    ],
  ],];
@endphp
@extends('layouts.app');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            {{-- creo una nav bar iniziale con la disposizione dei link con la visualizzazione breadcrumbs --}}
            <nav aria-label='breadcrumb'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pages</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    {{-- titolo pagina --}}
                    <h2>Pages</h2>
                </div>
                <div class="offset-3 col-3">
                    {{-- salto lo spazio di 3 col, prendo 3 col e creo un link al create --}}
                    <a href="{{route('admin.pages.create')}}">Crea una pagina</a>
                </div>
            </div>
            <table class="table">
                <thead="thead-light">
                {{-- creo la testata della tabella con le varie diciture, poi occupo 3 col per i pulsanti --}}
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- creo un ciclo in cui stampo ogni pagina presente nel db/array dati --}}
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{$page['id']}}</td>
                            <td>{{$page['title']}}</td>
                            <td>{{$page['category']}}</td>
                            <td>
                                {{-- dato che ci possono essere più tag nella stessa pagina, faccio un foreach per stampare ogni tag --}}
                                @foreach ($page['tags'] as $tag)
                                    {{$tag}}
                                    {{-- se non è l'ultimo elemento del loop, aggiungo una virgola per differenziare --}}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            {{-- Creo i pulsanti con Show, Edit e delete. Per il delete ovviamente c'è bisogno di un form apposito --}}
                            <td><a class="btn btn-primary" href="#">Visualizza</a></td>
                            <td><a class="btn btn-secondary" href="#">Modifica</a></td>
                            <td><form action="" method="post">
                                @method('DELETE');
                                @csrf
                                <input type="btn btn-danger" type="submit" value="Elimina"></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
