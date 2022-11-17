@extends('layout')

@section('link')
    <link rel="stylesheet" href="/styles/autocomplete.min.css"/>
@endsection
@section('content')
    @if(isset($review))
        <form method="POST" action="{{route('update',$review->id)}}" class="col-lg-6 offset-lg-3 mt-5" enctype="multipart/form-data">
        @else
<form method="POST" action="{{route('store_review')}}" class="col-lg-6 offset-lg-3 mt-5" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="form-group row mt-2 ">
        <label for="text" class="col-3 col-form-label">Название</label>
        <div class="col-8">
            @if(isset($review))
                <input id="text" name="title" type="text" class="form-control" value="{{$review->title}}">
                @else
            <input id="text" name="title" type="text" class="form-control">
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="textarea" class="col-3 col-form-label">Текст отзыва</label>
        <div class="col-8 mt-2">
            @if(isset($review))
                <textarea id="textarea" name="text" cols="40" rows="5" class="form-control" >{{$review->text}}</textarea>
            @else
            <textarea id="textarea" name="text" cols="40" rows="5" class="form-control"></textarea>
            @endif
        </div>
    </div>
    <div class="form-group row mt-2 ">
        <label for="basic" class="col-3 col-form-label">Город</label>
        <div class="col-8 mt-2">
            @if(isset($review))
                <input id="basic" name="city" type="text" value="@isset($city){{$city->name}} @endisset" class="form-control ml-1">
            @else
            <input id="basic" name="city" type="text" class="form-control ml-1">
            @endif
        </div>

    </div>
    <div class="form-group row mt-2 ">
        <div class="container d-flex align-content-center">
            <label class="col-3 col-form-label">Рейтинг</label>
            @if(isset($review))
                <div class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="rating" class="rating-value" value="{{$review->rating}}">
                </div>
            @else
            <div class="star-rating">
                <span class="fa fa-star-o" data-rating="1"></span>
                <span class="fa fa-star-o" data-rating="2"></span>
                <span class="fa fa-star-o" data-rating="3"></span>
                <span class="fa fa-star-o" data-rating="4"></span>
                <span class="fa fa-star-o" data-rating="5"></span>
                <input type="hidden" name="rating" class="rating-value" value="5">
            </div>
            @endif
        </div>
        <div class="mb-3 d-flex mt-2">
            <label for="formFile" class="form-label col-3">Загрузить изображение</label>
            @if(isset($review))
                <div class="col-8">
                    <input value="" name="file" class="form-control" type="file" id="formFile">
                </div>
                @else
            <div class="col-8">
                <input name="file" class="form-control" type="file" id="formFile">
            </div>
            @endif

        </div>
        @if(isset($review->img))
            <div class="offset-3">
                <img src="{{ Illuminate\Support\Facades\Storage::url($review->img) }}" height="150px">
            </div>
        @endif
        <div class="form-group row mt-2">
            <div class="offset-6 col-1">
                <button  type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.5/dist/js/autocomplete.min.js"></script>
<script src="/js.js"></script>

@endsection
