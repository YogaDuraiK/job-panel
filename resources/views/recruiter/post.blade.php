@extends('layout.common')

@section('content')

<div class="whole-wrap" style="margin-top:20px;">
    <div class="container box_1170">
        <!-- <div class="section-top-border"> -->
        <div class="col-sm-12" style="text-align:right;">
            <div class="form-group">
                <a href="{{url('add-edit-post-view')}}" class="button button-contactForm boxed-btn">Add Post</a>
            </div>
        </div>
        <div class="progress-table-wrap">
            @if(count($list) > 0)
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">#</div>
                    <div class="visit">Title</div>
                    <div class="visit">Description</div>
                    <div class="visit">Skill</div>
                    <!-- <div class="serial">Experience</div> -->
                    <div class="visit">Status</div>
                    <div class="visit">Action</div>
                </div>
                @foreach($list as $key => $value)
                <div class="table-row">
                    <div class="serial">{{ $key + 1 }}</div>
                    <div class="visit">{{ $value->title }}</div>
                    <div class="visit">{{ $value->description }}</div>
                    <div class="visit">{{ $value->skils }}</div>
                    <!-- <div class="serial">{{ $value->experience }}</div> -->
                    <div class="visit">
                        @if($value->status == 'active')
                        <a href="{{ url('status_update-post?id='.$value->id.'&status='.$value->status) }}"
                            class="genric-btn success small">Active</a>
                        @else
                        <a href="{{ url('status_update-post?id='.$value->id.'&status='.$value->status) }}"
                            class="genric-btn danger small">Inactive</a>
                        @endif
                    </div>
                    <div class="visit">
                        <a href="{{ url('add-edit-post-view?id='.$value->id) }}"
                            class="genric-btn warning small">Edit</a>&nbsp;&nbsp;
                        <a href="{{ url('delete-post?id='.$value->id) }}" class="genric-btn danger small">Delete</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="col-sm-12" style="text-align:center;">
                <p>Data Not Found</p>
            </div>
            @endif
        </div>
        <!-- </div> -->
    </div>
</div>

@endsection