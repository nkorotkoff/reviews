@extends('layout')

@section('content')
        <div class="container">
            <h2 class="text-center my-5">Добро пожаловать на сайт</h2>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{route('sessions')}}">
                @csrf
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <h2 class="quest"></h2>



                            <input type="hidden" name="city" class="cityinput" value=""/>

                        </div>
                        <div class="modal-footer">
                            <a href="{{route("index")}}" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</a>
                            <button type="submit" class="btn btn-primary">Да</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <script>

            const options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };
            async  function success(pos) {
                $(window).on('load', function() {
                    $('#exampleModal').modal('show');
                });
                const crd = pos.coords;
                let query = {
                    lat : crd.latitude,
                    lon:crd.longitude
                }
                var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/geolocate/address";
                var token = "baeb38753a639e0f10f3bf01eda452d6014b9be4";
                var optionsFetch = {
                    method: "POST",
                    mode: "cors",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "Authorization": "Token " + token
                    },
                    body: JSON.stringify(query)
                }
                const res =   await  fetch(url, optionsFetch)
                    .then(response => response.json())
                    .then(result => {return result.suggestions[0].data.city})
                    .catch(error => console.log("error", error));


                const quest = document.querySelector('.quest')
                quest.innerHTML = `Ваш город ${res}?`
                const cityinput = document.querySelector('.cityinput')
                cityinput.value = res;

            }

            function error(err) {

                window.location.replace('http://127.0.0.1:8000/citys');
            }

            navigator.geolocation.getCurrentPosition(success, error, options);


        </script>
@endsection
