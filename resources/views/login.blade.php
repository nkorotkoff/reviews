@extends('layout')
@section('link')
    <link rel="stylesheet" href="./styles/regStyles.css"/>
@endsection

@section('content')
    <div class="main">
        <section class="signup">

            <div class="container_reg">
                <div class="signup-content">
                    <form method="POST" action="{{route('signIn')}}" id="signup-form" class="signup-form">
                        @csrf
                        <h2 class="form-title">Войти</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Пароль">
                            <span toggle="#password" class="zmdi field-icon toggle-password zmdi-eye"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" id="submit" class="form-submit" >Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
