@extends('layout')

@section('content')

    <main class="container mt-2 ">

        <h4 class="ml-2" >Города для которых добавлены отзывы</h4>

        <ul class="list-group ">
            @foreach($citys as $city)
            <li class="list-group-item mx-1">
                <a class="text-decoration-none" href="{{route('reviews_name',$city->name)}}">{{$city->name}}</a>
            </li>
            @endforeach
        </ul>

    </main>


@endsection
