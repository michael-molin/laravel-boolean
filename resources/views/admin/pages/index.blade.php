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
            <nav aria-label='breadcrumb'>
                <ol class="breadcrumb">
                    
                </ol>

            </nav>
        </div>
    </div>
</div>
@endsection
