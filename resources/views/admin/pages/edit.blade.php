@php
// recupero i dati fake creati a lezione
$categories =  [
              [
                'id' => 1,
                'name' =>'Miscellanea'
              ],
              [
                'id' => 2,
                'name' =>'Lorem'
              ],
              [
                'id' => 3,
                'name' =>'Ipsum'
              ],
              [
                'id' => 4,
                'name' =>'Dolor'
              ],
              [
                'id' => 5,
                'name' =>'Sit'
              ]];
$tags = [
          [
            'id' => 1,
            'name' => 'Tag 1'
          ],
          [
            'id' => 2,
            'name' => 'Tag 2'
          ],
          [
            'id' => 3,
            'name' => 'Tag 3'
          ],
          [
            'id' => 4,
            'name' => 'Tag 4'
          ],
          [
            'id' => 5,
            'name' => 'Tag 5'
          ],
          [
            'id' => 6,
            'name' => 'Tag 6'
          ],
          [
            'id' => 7,
            'name' => 'Tag 7'
          ],];
$photos = [
  [
    'id' => 1,
    'title' => 'Lorem ipsum',
    'path' => 'images/nomefoto.jpg'
  ],
    [
      'id' => 2,
      'title' => 'Due Lorem ipsum',
      'path' => 'images/nomefoto.jpg'
  ],
    [
      'id' => 3,
      'title' => 'Tre Lorem ipsum',
      'path' => 'images/nomefoto.jpg'
  ],]
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            {{-- creo una nav bar iniziale con la disposizione dei link con la visualizzazione breadcrumbs --}}
            <nav aria-label='breadcrumb'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <h2>Crea nuova Pagina</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="" method="post">
                        @method('POST')
                        @csrf
                        {{-- creo l'input con label associata per il titolo con gestione errori--}}
                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" class="form-control" id="title" placeholder="inserisci un titolo">
                            @error('title')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo l'input con label associata per il sommario con gestione errori --}}
                        <div class="form-group">
                            <label for="summary">Sommario</label>
                            <input type="text" class="form-control" id="summary" placeholder="inserisci il sommario">
                            @error('summary')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo la lista di select con le categorie con label associato con gestione errori --}}
                        <div class="form-group">
                            <label for="category">Categorie</label>
                            {{-- creo un select con le impostazioni di boostrap e poi creo un foreach che va ad inserire tante opzioni quante sono le categorie, il valore è un numero rappresentato dall'id della cat. Ma visualizzo il nome per comprensione --}}
                            <select name="category" id="category" class="custom-select">
                                @foreach ($categories as $category)
                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo l'input con label associata per il corpo del post con gestione errori --}}
                        <div class="form-group">
                            <label for="body">corpo</label>
                         <textarea class="form-control" name="body" id="body" rows="10"></textarea>
                         @error('body')
                           <small class="form-text">Errore</small>
                         @enderror
                       </div>

                        {{-- creo un raggruppamento, grazie a fieldset in cui inserisco tutti i tag della pagina, disposti inline con relativi errori --}}
                        <div class="form-group">
                            <fieldset>
                                <legend>Tags</legend>
                                @foreach ($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="tags[]" id="{{$tag['id']}}" value="{{$tag['id']}}">
                                        <label class="form-check-label" for="tag{{$tag['id']}}">{{$tag['name']}}</label>
                                    </div>
                                @endforeach
                                @error('tags')
                                  <small class="form-text">Errore</small>
                                @enderror
                            </fieldset>
                        </div>

                        {{-- creo un raggruppamento, grazie a fieldset in cui inserisco tutti le foto della pagina, disposti inline con relativi errori --}}
                        <div class="form-group">
                            <fieldset>
                                <legend>Photos</legend>
                                @foreach ($photos as $photo)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"  type="checkbox" name="photos[]" id="photo{{$photo['id']}}" value="{{$photo['id']}}">
                                        <label class="form-check-label" for="photo{{$photo['id']}}">{{$photo['title']}}
                                        <img src="{{$photo['path']}}" alt=""></label>
                                    </div>
                                @endforeach
                                @error('photos')
                                  <small class="form-text">Errore</small>
                                @enderror
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
