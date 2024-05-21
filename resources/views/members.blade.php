@extends('template')  

@section('title')Участники@endsection 

@section('main_content')

<x-app-layout>
    <x-slot name="header">

    </x-slot>
    
    <div class="container col-md-4 px-4 py-5 text-white my-conteiner">
<p class="lead text-white">Заказанные книги</p>
    @foreach($books as $book)
        @if (Auth::user()->is_admin == 1)
            <div class = "alert alert-warning">
                <h3>{{ $book->name }}  {{$book->email}}</h3>
                <b>{{ $book->author }}: {{ $book->book }}</b><br>
                <a href="{{ route('member_check', $book->id)}}" class="btn btn-danger btn-sm px-4 me-md-2" id='$book->id' role="button" aria-pressed="true">Удалить запись</a>
            </div>
        @else
            @if (Auth::user()->id == $book->member_id)
            <div class = "alert alert-warning">
                <h3>{{ $book->name }}  {{$book->email}}</h3>
                <b>{{ $book->author }}: {{ $book->book }}</b><br>
            </div>
            @endif
        @endif
    @endforeach
</div>
</x-app-layout>  

@endsection