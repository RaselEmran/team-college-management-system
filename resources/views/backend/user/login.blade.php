<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="@if(isset($appSettings['institute_settings']['name'])){{$appSettings['institute_settings']['name']}}@else SattSchool @endif">
     <meta name="keywords" content="school,college,management,result,exam,attendace,hostel,admission,events">
     <meta name="author" content="Satt it">
      <title>@if(isset($appSettings['institute_settings']['short_name'])){{$appSettings['institute_settings']['short_name']}} @else SattSchool @endif | login-page</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="icon" href="@if(isset($appSettings['institute_settings']['favicon'])){{asset('storage/logo/'.$appSettings['institute_settings']['favicon'])}} @else{{ asset('images/favicon.png') }}@endif" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
    
</head>

<body>
    <section class="login_1">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-10 col-md-12">
                    <div class="row" id="bd_area">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="pic_img1 mt-3">
                                <img class="" src="{{ asset('images/sattems.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 text-center">
                            <div class="pic_img">
                                <img src="@if(isset($appSettings['institute_settings']['logo'])) {{asset('storage/logo/'.$appSettings['institute_settings']['logo'])}} @else {{ asset('images/logo-lg.png') }} @endif" alt="">
                                {{-- <img class="" src="{{ asset('images/smmclogo.png') }}" alt=""> --}}
                            </div>
                        </div>
                        <div id="cres" class="col-lg-5 col-md-7">
                            <div class="bg-area11">
                                <img class="card-img" src="{{ asset('images/loginmb.png') }}" alt="Card image">
                                <div class="card-img-overlay ">
                                    <h1 class="text-center mt-5 pt-3">WELCOME !!!</h1>
                                    <form class="text-white" action="{{URL::Route('login')}}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Username or email </label>
                                            <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username" required>
                                             <span class="text-danger">{{ $errors->first('username') }}</span>
                                                <span class="text-danger">
                                                @if (Session::has('error'))
                                                  {{ Session::get('error') }}
                                                @endif
                                            </span>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1 d-block m-auto"> Passworld</label>
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                          
                                        </div>
                                        <div class="form-group form-check text-white">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" >
                                            <label class="form-check-label" for="exampleCheck1">Remember me
                                                &nbsp; <span> <a class="forget-pass float-right" href="{{URL::Route('forgot')}}"> Forget Password</a></span>
                                            </label>

                                        </div>
                                        <button type="submit" class="tri-button mt-5"><span>SIGN IN</span></button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">

                </div>


            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <script src="{{asset('js/toastr.min.js')}}"></script>
     <script>
            @if(session('error'))
        
             toastr.success('{{session('error')}}');
         @endif
     </script>
</body></html>
