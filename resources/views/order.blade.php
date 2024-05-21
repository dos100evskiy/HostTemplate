@extends('template')  

@section('title')Книги@endsection 

@section('main_content')
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    
    <div class="container col-md-8 px-4 py-5 text-white my-conteiner">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="/order/check">
        @csrf
        @if (Auth::user()->is_admin == 1)
        <p class="lead text-white">Email</p>
        <input type="email" name="email" id="email" placeholder="Введите email" class="form-control my-input"><br>
        @endif
        <p class="lead text-white">ФИО автора</p>
        <input type="author" name="author" id="author" placeholder="Введите ФИО автора" class="form-control my-input" ><br>
        <p class="lead text-white">Название книги</p>
        <input type="book" name="book" id="book" placeholder="Введите название книги" class="form-control my-input" ><br>
        <button id="orderBtn" type="submit" class="btn btn-success">Заказать</button>
    </form>
</div>
</x-app-layout>  
@endsection