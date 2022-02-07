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
                            <h4>{{$value->job_post->title}}</h4>(Description:
                            {{$value->job_post->description}})
                        </div>
                        <ul>
                            <li><i class="fa fa-building"></i>{{$value->recruiter_details->name}}</li>
                            <li><i class="fa fa-envelope"></i>{{$value->recruiter_details->email}}</li>
                            <li><i class="fa fa-phone"></i>{{$value->recruiter_details->phone}}</li>
                            <li><i class="fas fa-map-marker-alt"></i>{{$value->recruiter_details->address}}</li>
                            <li>Experience: {{$value->job_post->experience.' Yrs'}}</li>
                        </ul>
                    </div>
                </div>
                <div class="items-link f-right">
                    @if($value->status == 'applied')
                        <div class="genric-btn info circle arrow" style="cursor: default;">Applied</div>
                    @elseif($value->status == 'accepted')
                        <div class="genric-btn success circle arrow" style="cursor: default;">Accepted</div>
                    @else
                        <div class="genric-btn danger circle arrow" style="cursor: default;">Rejected</div>
                    @endif
                    <!-- <a href="{{ url('apply-job?post='.$value->id) }}">Apply</a> -->
                    <span>{{$value->job_post->skils}}</span>
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

    <section>

        @endsection