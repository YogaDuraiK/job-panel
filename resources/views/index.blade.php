@extends('layout.common')

@section('content')

<section class="featured-job-area feature-padding">
    @if(count($list) > 0)
    @foreach($list as $value)
    <div class="row justify-content-center">
        <div class="col-xl-10">

            <div class="single-job-items mb-30">
                <div class="job-items">
                    <div class="job-tittle">

                        <div>
                            <h4>{{$value->title}}</h4>(Description:
                            {{$value->description}})
                        </div>
                        <ul>
                            <li><i class="fa fa-building"></i>{{$value->recruiter_details->name}}</li>
                            <li><i class="fa fa-envelope"></i>{{$value->recruiter_details->email}}</li>
                            <li><i class="fa fa-phone"></i>{{$value->recruiter_details->phone}}</li>
                            <li><i class="fas fa-map-marker-alt"></i>{{$value->recruiter_details->address}}</li>
                            <li>Experience: {{$value->experience.' Yrs'}}</li>
                        </ul>
                    </div>
                </div>
                <div class="items-link f-right">
                    <a href="{{ url('job-seeker') }}">Apply</a>
                    <span>{{$value->skils}}</span>
                </div>
            </div>

        </div>
    </div>
    @endforeach
    @else
    <div class="col-sm-12" style="text-align:center;">
        <p>Job Not Found</p>
    </div>
    @endif

    <section>

        @endsection