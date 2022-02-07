@extends('layout.common')

@section('content')


<div class="container" style="margin-top: 30px;">

    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="contact-title">Recruiter Register</h2>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    <div class="form-group">
                        <a href="{{url('recruiter')}}" class="button button-contactForm boxed-btn">Login</a>
                    </div>
                </div>
            </div>

            <form class="form-contact contact_form" method="POST" action="{{ url('recruiter-register') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="name" id="name" type="text"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Company Name'"
                                placeholder="Company Name" value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <label for="email" class="error">{{ $errors->first('name') }}</label>
                        @endif
                        </div>
                       
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="email" id="email" type="email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address'"
                                placeholder="Email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <label for="email" class="error">{{ $errors->first('email') }}</label>
                        @endif
                        </div>
                       
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="phone" id="phone" type="text"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Phone Number'"
                                placeholder="Phone Number" value="{{ old('phone') }}">
                        @if($errors->has('phone'))
                            <label for="email" class="error">{{ $errors->first('phone') }}</label>
                        @endif
                        </div>
                       
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="password" id="password" type="password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'"
                                placeholder="Password" value="{{ old('password') }}">
                                @if($errors->has('password'))
                                    <label for="password" class="error">{{ $errors->first('password') }}</label>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="address" id="address" cols="30" rows="5" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Address'" placeholder=" Enter Address">{{old('address')}}</textarea>
                                @if($errors->has('address'))
                                    <label for="address" class="error">{{ $errors->first('address') }}</label>
                                @endif
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="button button-contactForm boxed-btn">Register</button>
                </div>

            </form>
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>


@endsection