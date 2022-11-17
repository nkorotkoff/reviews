@extends('layout')
@section('link')
    <link rel="stylesheet" href="/styles/star-rating-svg.css"/>
@endsection
@section('content')

<div class="container">
    <h4>Отзывы к городу {{$cityId->name}}</h4>

    @foreach($city as $review)
    <div class="card my-2" >
        <div class="card-body">
            <div class="d-flex">
            <h5 style="width:78%"  class="card-title">{{$review->title}}</h5>
                @guest
                    <div class="card-link">{{$review->user->fio}}</div>
                @endguest
                @auth
                    <a href="{{route('profile',$review->user->id)}}" class="card-link">{{$review->user->fio}}</a>
                @endauth
            </div>
            <h6 class="card-subtitle mb-2 text-muted">{{\Carbon\Carbon::parse($review->created_at)->format('m.d.Y')}}</h6>
            @if(!is_null($review->city_id))
                <div>{{$cityId->name}}</div>
            @else
                <div>Отзыв ко всем городам</div>
            @endif

                <div class="my-rating" data-rating="{{$review->rating}}"></div>
            <p class="card-text">
               {{$review->text}}
            </p>
            @if($review->img)
            <div>
                <h4>Фотографии</h4>
                <img src="{{ Illuminate\Support\Facades\Storage::url($review->img) }}" height="240px">
            </div>
            @endif


        </div>
    </div>
    @endforeach
</div>
<script src="/star-rating.js"></script>
<script>
    $(".my-rating").starRating({
        strokeColor: 'yellow',
        starShape: 'rounded',
        strokeWidth: 5,
        starSize: 20,
        readOnly: true
    });
</script>

@endsection
