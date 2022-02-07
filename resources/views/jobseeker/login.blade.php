@extends('layout.common')

@section('content')


<div class="container" style="margin-top: 30px;">

    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="contact-title">Job Seeker Login</h2>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    <div class="form-group">
                        <a href="{{url('job-seeker-register')}}" class="button button-contactForm boxed-btn">Register</a>
                    </div>
                </div>
            </div>

            <form class="form-contact contact_form" method="POST" action="{{ url('job-seeker') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control valid" name="email" id="email" type="email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"
                                placeholder="Email">
                        @if($errors->has('email'))
                            <label for="email" class="error">{{ $errors->first('email') }}</label>
                        @endif
                        </div>
                       
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control valid" name="password" id="password" type="password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter password'"
                                placeholder="Password">
                                @if($errors->has('password'))
                                    <label for="password" class="error">{{ $errors->first('password') }}</label>
                                @endif
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="button button-contactForm boxed-btn">Login</button>
                </div>

            </form>
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>


@endsection