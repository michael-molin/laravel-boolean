@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            {{-- creo una nav bar iniziale con la disposizione dei link con la visualizzazione breadcrumbs --}}
            <nav aria-label='breadcrumb'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.index')}}">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edita</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <h2>Edita {{$page['title']}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="" method="post">
                        @method('PUT')
                        @csrf
                        {{-- modifico l'input con label associata per il titolo con gestione errori che ha come valore il titolo della pagina creato precedentemente--}}
                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" class="form-control" id="title" placeholder="inserisci un titolo" value="{{$page['title']}}">
                            @error('title')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- modifico l'input con label associata per il sommario con gestione errori che ha come valore il sommario della pagina creato precedentemente--}}
                        <div class="form-group">
                            <label for="summary">Sommario</label>
                            <input type="text" class="form-control" id="summary" placeholder="inserisci il sommario" value="{{$page['summary']}}">
                            @error('summary')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo la lista di select con le categorie con label associato con gestione errori --}}
                        <div class="form-group">
                            <label for="category">Categorie</label>
                            {{-- creo un select con le impostazioni di boostrap e poi creo un foreach che va ad inserire tante opzioni quante sono le categorie, il valore è un numero rappresentato dall'id della cat. Ma visualizzo il nome per comprensione --}}
                            {{-- se l'id della categoria, assegnato alla creazione è uguale a category_id di page (Quindi la categoria assegnata in precedenza) significa che è la stessa categoria quindi viene selezionata in quanto è lo stesso dato  --}}
                            <select name="category_id" id="category" class="custom-select">
                                @foreach ($categories as $category)
                                    <option value="{{$category['id']}}" {{($category['id'] == $page['category_id']) ? 'selected' : ''}}>{{$category['name']}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="form-error">Errore</small>
                            @enderror
                        </div>

                        {{-- creo l'input con label associata per il corpo del post con gestione errori e nel text area il testo precedentemente creato ( Non è nel value per via del text area) --}}
                        <div class="form-group">
                            <label for="body">corpo</label>
                         <textarea class="form-control" name="body" id="body" rows="10"> {{$page['body']}}</textarea>
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
                                        <input class="form-check-input" type="checkbox" name="tags[]" id="{{$tag['id']}}" value="{{$tag['id']}}"
                                        {{-- faccio un check se l'id del tag è presente nell'array oldtags OPPURE se è presente nell'array tags di page --}}
                                        {{(
                                            (in_array($tag['id'], $oldtags) == true) ||
                                            (in_array($tag['id'], $page['tags']) == true)
                                          ) ? 'checked' : ''  )}}>
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
                                        <input class="form-check-input"  type="checkbox" name="photos[]" id="photo{{$photo['id']}}" value="{{$photo['id']}} {{(in_array($photo['id'],  $page['photos']) == true) ? 'checked' : ''}}>">
                                        <label class="form-check-label" for="photo{{$photo['id']}}">{{$photo['title']}}
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
