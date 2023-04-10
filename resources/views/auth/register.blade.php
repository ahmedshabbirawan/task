<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    {{-- <link href="signin.css" rel="stylesheet"> --}}

    <style>

html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}


    </style>

  </head>

  <body class="text-center">

  
    
        <form method="POST" class="form-signin" action="{{ route('register') }}">
            @csrf
      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>


      <div>

        @include('layouts.alerts')

    </div>



    <div>
       
        <label for="inputEmail" class="sr-only">Name</label>
        <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus />
    </div>

    <!-- Email Address -->
    <div class="mt-0">
        
        <label for="inputEmail" class="sr-only">Email address</label>
        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email" required />
    </div>

    <!-- Password -->
    <div class="mt-0">
       
        <label for="inputEmail" class="sr-only">Password</label>
        <x-input id="password" class="form-control"
                        type="password"
                        name="password"
                        required autocomplete="new-password" placeholder="Password" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-0">
        
        <label for="inputEmail" class="sr-only">Confirm Password</label>
        <x-input id="password_confirmation" class="form-control"
                        type="password"
                        name="password_confirmation" required placeholder="Confirm Password" />
    </div>


    <div class="mt-0">


      <div class="form-check col-lg-12" style="text-align: left;"  >
      <label for="inputEmail" >Register as</label>
      </div>

      <div class="form-check col-lg-12" style="text-align: left;" >
        <input class="form-check-input" type="radio" name="role" id="customer" value="customer" checked>
        <label class="form-check-label" for="customer">
          Customer
        </label>
      </div>
      <div class="form-check col-lg-12" style="text-align: left;" >
        <input class="form-check-input" type="radio" name="role" id="business_owner" value="business_owner">
        <label class="form-check-label" for="business_owner">
          Business Owner
        </label>
      </div>



    </div>


      




      <div class="checkbox mb-3">
        
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

      @if (Route::has('register'))
      
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      
  @endif


      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
