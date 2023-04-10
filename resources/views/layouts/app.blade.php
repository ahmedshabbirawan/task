<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Album example for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">

              <ul class="list-unstyled">

               

              @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                              <h4 class="text-white">
                                    {{ Auth::user()->name }}
                              </h4>
                            </li>

                            <li class="nav-item">
                              <a class="text-white" href="{{ route('main') }}">{{ __('Home') }}</a>
                          </li>

                              <li>
                                    <a class="text-white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                      </ul> 

              {{-- <h4 class="text-white">Ahmed</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                <li><a href="#" class="text-white">Like on Facebook</a></li>
                <li><a href="#" class="text-white">Email me</a></li>
              </ul> --}}



            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="{{ route('main') }}" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
              <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Business Directory</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    @yield('content')

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script> --}}

    

    <script src="{{ asset('jquery/jquery.js') }}" ></script>
    
    <script src="{{ asset('bootstrap/assets/js/vendor/popper.min.js') }}" ></script>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" ></script>
    
    <script src="{{ asset('bootstrap/assets/js/vendor/holder.min.js') }}" ></script>

    <script>


  var ajaxFailBlock = function(jqXHR, textStatus, errorThrown) {
    // console.log(textStatus,jqXHR, errorThrown);
    $('#submit-delivery').removeAttr('disabled');
     if (jqXHR.status != 200) {
      if (typeof jqXHR.responseJSON !== 'undefined') {
        alert(jqXHR.responseJSON.message);
      }else{
        alert('Unknow Error');
      }
    }
  }

  function sendPostRequest(url, data, successBlock){
    $.ajax({
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        type: 'POST',
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        success: successBlock,
        error: ajaxFailBlock
    });
  }

  function sendGetRequest(url, successBlock){
    $.ajax({
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        type: 'GET',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        success: successBlock,
        error: ajaxFailBlock
    });
  }
    </script>
    @yield('javascript')
  </body>


  <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>


<script>

    <?php if( isset(auth()->user()->id) ){ ?>

    var remoteToken =    '{{ auth()->user()->device_token }}';

    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyApxuBj27RF7ClTDreltczNETM3ZR2ZKaw",
        authDomain: "jobtask-d9023.firebaseapp.com",
        projectId: "jobtask-d9023",
        storageBucket: "jobtask-d9023.appspot.com",
        messagingSenderId: "825058826236",
        appId: "1:825058826236:web:6707dea46346d1b47ac479",
        measurementId: "G-HRW03PR3LZ"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {
          if(token != remoteToken){

            const formData = new FormData();
            formData.append("device_token", token);
            sendPostRequest("{{ route('save-token') }}", formData , function(res, textStatus, jqXHR){
              if (jqXHR.status == 200) {
                
              }
            });
          }
        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();

    messaging.onMessage((payload) => {
      console.log('Message received. ', payload);
      new Notification(payload.notification.title, {'logo' : payload});
      alert(payload.notification.title);
    });

    <?php } ?>
</script>


</html>
