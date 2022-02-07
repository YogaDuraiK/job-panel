@extends('layout.common')

@section('content')


<div class="container" style="margin-top: 30px;">

    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="contact-title">Job Seeker Register</h2>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    <div class="form-group">
                        <a href="{{url('job-seeker')}}" class="button button-contactForm boxed-btn">Login</a>
                    </div>
                </div>
            </div>

            <form class="form-contact contact_form" method="POST" action="{{ url('job-seeker-register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="name" id="name" type="text"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'"
                                placeholder="Name" value="{{ old('name') }}">
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
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input class="form-control valid" name="experience" id="experience" type="number"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Experience'"
                                placeholder="Experience" value="{{ old('experience') }}">
                                @if($errors->has('experience'))
                                    <label for="experience" class="error">{{ $errors->first('experience') }}</label>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input class="form-control valid" name="notice_period" id="notice_period" type="number"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Notice Period'"
                                placeholder="Notice Period" value="{{ old('notice_period') }}">
                                @if($errors->has('notice_period'))
                                    <label for="notice_period" class="error">{{ $errors->first('notice_period') }}</label>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control valid" style="width:100% !important" name="job_location" id="job_location">
                                <option value="">Location</option>
                                @foreach($location as $val)
                                    <option value="{{$val->name}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                            <!-- <input class="form-control valid" name="job_location" id="job_location" type="text"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Job Location'"
                                placeholder="Job Location" value="{{ old('job_location') }}"> -->
                                @if($errors->has('job_location'))
                                    <label for="job_location" class="error">{{ $errors->first('job_location') }}</label>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input class="form-control valid" name="photo" id="photo" type="file">
                            <label>Photo</label>
                                @if($errors->has('photo'))
                                    <label for="photo" class="error">{{ $errors->first('photo') }}</label>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input class="form-control valid" name="resume" id="resume" type="file">
                            <label>Resume</label>
                                @if($errors->has('resume'))
                                    <label for="resume" class="error">{{ $errors->first('resume') }}</label>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input class="form-control valid" name="skils" id="skils" type="text"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Skils With comma(,) Saparation'"
                                placeholder="Skils" value="{{ old('skils') }}">
                                <label>Comma(,) Saparation</label>
                                @if($errors->has('skils'))
                                    <label for="skils" class="error">{{ $errors->first('skils') }}</label>
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