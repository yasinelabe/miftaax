@extends('layout.offline')

@section('content')
    <div class="animate form login_form mt-4">
        <img width="150" src="{{ URL::asset('images/logo.png') }}" alt="">
        <section class="login_content">
            <form action="/verify_login" method="post">
                @csrf
                <h1>Login Form</h1>

                @if (Session::has('error'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                @endif
                <div>
                    <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div>
                    <button class="btn btn-sm btn-success" type="submit">Log in</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><i class="fa fa-book"></i> {{ env('APP_NAME') }}!</h1>
                        <p>
                            ©@php
                                echo date('Y');
                            @endphp All Rights Reserved. {{ env('APP_NAME') }}</p>
                    </div>
                </div>
            </form>
        </section>
    @endsection
