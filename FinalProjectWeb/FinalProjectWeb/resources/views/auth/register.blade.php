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

        .regist {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            width: 400px;
            border-radius: 20px;
            overflow-y: hidden; /* Hide vertical scrollbar */
        }

        .regist h1 {
            text-align: center;
            padding: 20px 0 20px 0;
            color: blueviolet;
            letter-spacing: 7px;
        }

        .regist form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        .regist-input {
            position: relative;
            border-bottom: 2px solid blueviolet;
            margin: 30px 0;
        }

        .regist-input input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            outline: none;
        }

        .regist-input label {
            position: absolute;
            top: -35px;
            left: 5px;
            color: blueviolet;
            font-size: 16px;
            pointer-events: none;
        }

        .regist-input::before {
            content: '';
            position: absolute;
            top: 40px;
        }

        /* Style for password input */
        .pass {
            position: relative;
            border-bottom: 2px solid blueviolet;
            margin: 0;
        }

        .pass input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            outline: none;
            color: blueviolet;
        }

        .pass label {
            position: absolute;
            top: -35px;
            left: 5px;
            color: blueviolet;
            font-size: 16px;
            pointer-events: none;
        }

        .cpass {
            position: relative;
            border-bottom: 2px solid blueviolet;
            margin: 30px 0;
        }

        .cpass input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            outline: none;
            color: blueviolet;
        }

        .cpass label {
            position: absolute;
            top: -35px;
            left: 5px;
            color: blueviolet;
            font-size: 16px;
            pointer-events: none;
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

        .role label {
            display: block;
            color: blueviolet;
        }

        .role select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid blueviolet;
            border-radius: 5px;
            font-size: 16px;
        }

        .sign-in {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
        }

        .sign-in a {
            text-decoration: none;
            color: blueviolet;
        }
    </style>

    <div class="container">
                    <div class="card-body">
                        <div class="regist">
                            <h1>REGISTER</h1>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="regist-input">
                                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <span></span>
                                    <label>Name</label>
                                </div>
                                <br>
                                <div class="regist-input">
                                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                                    <span></span>
                                    <label>Email Address</label>
                                </div>
                                <br>
                                <div class="pass">
                                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                                    <span></span>
                                    <label>Password</label>
                                </div>
                                <br>
                                <div class="cpass">
                                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                                    <span></span>
                                    <label>Confirm Password</label>
                                </div>
                                <div class="role">
                                    <label>Role</label>
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                        <option value="seeker" {{ old('role') == 'seeker' ? 'selected' : '' }}>Pelamar</option>
                                        <option value="recruter" {{ old('role') == 'recruter' ? 'selected' : '' }}>Penyedia Lamaran</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br>
                                <div class="sign-in">
                                <a href="{{ route('login') }}">Sign in</a>
                                </div>
                                <input type="submit" name="Register" value="Register">
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
