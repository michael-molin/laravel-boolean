@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            {{-- creo una nav bar iniziale con la disposizione dei link con la visualizzazione breadcrumbs --}}
            <nav aria-label='breadcrumb'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.index')}}">Home</a></li>
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
                    <form action="{{route('admin.pages.store')}}" method="post">
                        @method('POST')
                        @csrf
                        {{-- Switch visibile per la visualizzazione dei post nell'area guest --}}
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitches" name="visible">
                          <label class="custom-control-label" for="customSwitches">Visible</label>
                        </div>

                        {{-- creo l'input con label associata per il titolo con gestione errori--}}
                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="inserisci un titolo">
                            @error('title')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo l'input con label associata per il sommario con gestione errori --}}
                        <div class="form-group">
                            <label for="summary">Sommario</label>
                            <input type="text" name="summary" class="form-control" id="summary" placeholder="inserisci il sommario">
                            @error('summary')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo la lista di select con le categorie con label associato con gestione errori --}}
                        <div class="form-group">
                            <label for="category">Categorie</label>
                            {{-- creo un select con le impostazioni di boostrap e poi creo un foreach che va ad inserire tante opzioni quante sono le categorie, il valore è un numero rappresentato dall'id della cat. Ma visualizzo il nome per comprensione --}}
                            <select name="category_id" id="category" class="custom-select">
                                @foreach ($categories as $category)
                                    <option value="{{$category['id']}}" name="category">{{$category['name']}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo l'input con label associata per il corpo del post con gestione errori --}}
                        <div class="form-group">
                            <label for="body">Corpo</label>
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
                                        <label class="form-check-label" for="photo{{$photo['id']}}">{{$photo['name']}}
                                        <img src="{{$photo['path']}}" alt=""></label>
                                    </div>
                                @endforeach
                                @error('photos')
                                  <small class="form-text">Errore</small>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Salva">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
