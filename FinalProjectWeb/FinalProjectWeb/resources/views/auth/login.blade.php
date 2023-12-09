@extends('layouts.app')

@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            background-image: linear-gradient(to right top, violet, blueviolet);
            height: 100vh;
            overflow: hidden;
        }

        .login {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            width: 400px;
            border-radius: 20px;
        }

        .login h1 {
            text-align: center;
            padding: 20px 0 20px 0;
            color: blueviolet;
            letter-spacing: 7px;
        }

        .login form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        .form-input {
            position: relative;
            border-bottom: 2px solid blueviolet;
            margin: 30px 0;
        }

        .form-input input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            outline: none;
        }

        .form-input label {
            position: absolute;
            top: -35px;
            left: 5px;
            color: blueviolet;
            font-size: 16px;
            pointer-events: none;
        }

        .form-input::before {
            content: '';
            position: absolute;
            top: 40px;
        }

        .pass {
            margin: -5px 0 20px 5px;
            color: blueviolet;
            cursor: pointer;
        }

        .pass:hover {
            text-decoration: underline;
        }

        input[type="submit"] {
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: blueviolet;
            border-radius: 25px;
            font-size: 18px;
            color: white;
            letter-spacing: 5px;
            font-weight: 700;
            outline: none;
        }

        input[type="submit"]:hover {
            background: violet;
        }

        .sign-up {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
        }

        .sign-up a {
            text-decoration: none;
            color: blueviolet;
        }
    </style>

    <div class="container">
                    <div class="card-body">
                        <div class="login">
                            <h1>LOGIN</h1>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-input">
                                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span></span>
                                    <label>Email Address</label>
                                </div>
                                <br>

                                <div class="form-input">
                                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                                    <span></span>
                                    <label>Password</label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Login</button>

                                <div class="sign-up">
                                    Not a member? <a href="{{ route('register') }}">Sign up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
