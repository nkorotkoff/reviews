@extends('layout')

@section('content')

    <div class="container">
        <h4>Профиль </h4>


        <div class="card my-2">
            <div class="card-body">
                <h5 class="card-title">ФИО :{{$user->fio}}</h5>
                <h5 style="width:78%" class="card-title">Email:{{$user->email}}</h5>

                <h5 class="card-title">Номер телефона:{{$user->phone}}</h5>
                <a href="{{route('profile_reviews',$user->id)}}" class="card-link">Показать все отзывы автора</a>

            </div>
        </div>

    </div>

@endsection
