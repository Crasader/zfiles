@extends('user.--index')

@section('confirm_email')

    <div style=" padding: 30px 15px;" class="header-content">
        <div class="header-content-inner" style="color: #fefefe;">
            <h1>Please confirm email <b>{{ Auth::user()->email }}</b> to continue !
            </br>

            </br>
                If you have not received the confirmation email, <a style="color: red;" href="{{ url('user/' . Auth::user()->username . '/' . 'send_back_email') }}">Sendback</a> !
            </h1>
        </div>
    </div>

@endsection