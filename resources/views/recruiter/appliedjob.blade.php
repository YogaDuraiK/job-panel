@extends('layout.common')

@section('content')


<section class="featured-job-area feature-padding">
    @if(count($list) > 0)
    @foreach($list as $value)
    <div class="row justify-content-center">
        <div class="col-xl-10">

            <div class="single-job-items mb-30">
                <div class="job-items">
                    <div class="company-img">
                        <img src="{{'file/photo/'.$value->job_seeker->photo}}" width="70" height="70" alt="">
                    </div>
                    <div class="job-tittle">

                        <div>
                            <h4>{{$value->job_seeker->name}}</h4>(Experience:
                            {{$value->job_seeker->experience.' Yrs, Notice Period: '.$value->job_seeker->notice_period.' Days'}} &nbsp; <a class="down_resume" href="{{'file/resume/'.$value->job_seeker->resume}}" download>Download Resume</a>)
                        </div>
                        <!-- <a href="{{'file/resume/'.$value->resume}}" style="color:#1311b9" download>Download Resume</a> -->
                        <ul>
                            <li><i class="fa fa-envelope"></i>{{$value->job_seeker->email}}</li>
                            <li><i class="fa fa-phone"></i>{{$value->job_seeker->phone}}</li>
                            <li><i class="fas fa-map-marker-alt"></i>{{$value->job_seeker->job_location}}</li>
                            <li><i class="fa fa-graduation-cap"></i>{{$value->job_seeker->skils}}</li>
                        </ul>
                    </div>
                </div>
                <div class="items-link f-right">
                    @if($value->status == 'applied')
                    <a href="{{ url('applied-job-status?id='.$value->id.'&status=accepted') }}"
                            class="genric-btn success small" style="margin-bottom: 5px;">Approve</a>
                        <a href="{{ url('applied-job-status?id='.$value->id.'&status=rejected') }}" class="genric-btn danger small" style="margin-bottom: 5px;">Reject</a>
                    @elseif($value->status == 'accepted')
                        <div class="genric-btn success circle arrow" style="cursor: default;">Accepted</div>
                    @else
                        <div class="genric-btn danger circle arrow" style="cursor: default;">Rejected</div>
                    @endif
                    <!-- <a href="{{'file/resume/'.$value->resume}}" download>Download Resume</a> -->
                    <span>{{$value->job_post->title}}</span>
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