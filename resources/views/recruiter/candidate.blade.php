@extends('layout.common')

@section('content')


<section class="featured-job-area feature-padding">
    <div class="container">
        <form class="form-contact contact_form" method="POST" action="{{ url('candidates') }}">
            <div class="row">

                @csrf

                <div class="col-sm-2" style="float:left;">
                    <div class="form-group" style="text-align:left">
                        <label for="skils">Skills</label>
                        <input class="form-control" name="skils" id="skils" type="text" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Skils'" placeholder="Skils">

                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group" style="text-align:left">
                        <label for="skils">Notice Period</label>
                        <input class="form-control" name="notice_period" id="notice_period" type="number"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Notice Period'"
                            placeholder="Notice Period">

                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group" style="text-align:left">
                        <label for="skils">Min Experience</label>
                        <input class="form-control" name="min" id="min" type="number" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Min Experience'" placeholder="Min Experience">

                    </div>

                </div>
                <div class="col-sm-2">
                    <div class="form-group" style="text-align:left">
                        <label for="skils">Max Experience</label>
                        <input class="form-control" name="max" id="max" type="number" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Max Experience'" placeholder="Max Experience">

                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group" style="text-align:left">
                        <label for="skils">Location</label>
                        <input class="form-control" name="location" id="location" type="text"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Location'"
                            placeholder="Location">

                    </div>
                </div>
                <div class="col-sm-2">
                    <div style="margin-top: 35px;">
                        <button type="submit" class="genric-btn info circle arrow">Apply Filter</button>
                    </div>
                </div>


            </div>
        </form>
    </div>
    @if(count($list) > 0)
    @foreach($list as $value)
    <div class="row justify-content-center">
        <div class="col-xl-10">

            <div class="single-job-items mb-30">
                <div class="job-items">
                    <div class="company-img">
                        <img src="{{'file/photo/'.$value->photo}}" width="70" height="70" alt="">
                    </div>
                    <div class="job-tittle">

                        <div>
                            <h4>{{$value->name}}</h4>(Experience:
                            {{$value->experience.' Yrs, Notice Period: '.$value->notice_period.' Days'}})
                        </div>
                        <!-- <a href="{{'file/resume/'.$value->resume}}" style="color:#1311b9" download>Download Resume</a> -->
                        <ul>
                            <li><i class="fa fa-envelope"></i>{{$value->email}}</li>
                            <li><i class="fa fa-phone"></i>{{$value->phone}}</li>
                            <li><i class="fas fa-map-marker-alt"></i>{{$value->job_location}}</li>
                        </ul>
                    </div>
                </div>
                <div class="items-link f-right">
                    <a href="{{'file/resume/'.$value->resume}}" download>Download Resume</a>
                    <span>{{$value->skils}}</span>
                </div>
            </div>

        </div>
    </div>
    @endforeach
    @else
    <div class="col-sm-12" style="text-align:center;">
        <p>Data Not Found</p>
    </div>
    @endif

</section>

@endsection