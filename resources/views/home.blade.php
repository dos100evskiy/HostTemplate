@extends('template')  

@section('title')Главная страница@endsection 

@section('main_content')

<x-app-layout>
    <x-slot name="header">

    </x-slot>
    
    <div class="container col-md-4 px-80 py-12">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold lh-1 mb-3 text-white">Библиотека</h1>
          @if (Auth::user()->is_admin == 0)
          <p class="lead text-white">Тут ты можешь выбрать книгу себе по душе</p>
         @else
          <p class="lead text-white">Ты администратор</p>
          @endif
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a href="/order" class="btn btn-primary btn-lg px-4 me-md-2" role="button" aria-pressed="true">Заказать книгу</a>
        <a href="/members" class="btn btn-outline-secondary btn-lg px-4" role="button" aria-pressed="true">Заказы</a>
        </div>
      </div>
        <div>
			<img src = "/imgs/1.jpg">
        </div>
    </div>
  </div>

</x-app-layout>      


@endsection
