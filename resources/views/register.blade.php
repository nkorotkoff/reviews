@extends('layout')
    @section('link')
        <link rel="stylesheet" href="./styles/regStyles.css"/>
    @endsection

@section('content')

<div class="main">
    <section class="signup">

        <div class="container_reg">
            <div class="signup-content">
                <form method="POST" action="{{route('create_user')}}" id="signup-form" class="signup-form">
                    @csrf
                    <h2 class="form-title">Создать аккаунт</h2>
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" id="name" placeholder="ФИО">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-input" name="phone" id="phone" >
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password" id="password" placeholder="Пароль">
                        <span toggle="#password" class="zmdi field-icon toggle-password zmdi-eye"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password_confirmation" id="re_password" placeholder="Повторите пароль">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-danger" class="reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input id="captcha" type="text" class="form-control" placeholder="Введите капчу" name="captcha">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" id="submit" class="form-submit" >Зарегистрироваться</button>
                    </div>
                </form>
                <p class="loginhere">
                    Уже есть аккаунт ? <a href="#" class="loginhere-link">Войти</a>
                </p>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
<script src="https://unpkg.com/imask"></script>
    <script>
        var element = document.getElementById('phone');
        var maskOptions = {
            mask: '+7(000)000-00-00',
            lazy: false
        }
        var mask = new IMask(element, maskOptions);

        var element2 = document.getElementById('email');
        var maskOptions2 = {
            mask:function (value) {
                if(/^[a-z0-9_\.-]+$/.test(value))
                    return true;
                if(/^[a-z0-9_\.-]+@$/.test(value))
                    return true;
                if(/^[a-z0-9_\.-]+@[a-z0-9-]+$/.test(value))
                    return true;
                if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.$/.test(value))
                    return true;
                if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}$/.test(value))
                    return true;
                if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.$/.test(value))
                    return true;
                if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.[a-z]{1,4}$/.test(value))
                    return true;
                return false;
            },
            lazy: false
        }

    </script>
@endsection
