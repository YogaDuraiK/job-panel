@extends('layout.common')

@section('content')

<div class="container" style="margin-top: 30px;">

    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="contact-title">{{$details['id'] ? 'Edit Post' : 'Add Post'}}</h2>
                </div>
                <div class="col-sm-6" style="text-align:right;">
                    <div class="form-group">
                        <a href="{{url('job-post')}}" class="button button-contactForm boxed-btn">Back</a>
                    </div>
                </div>
            </div>

            <form class="form-contact contact_form" method="POST" action="{{ url('add-edit-post') }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $details['id'] }}" />
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="title" id="title" type="text"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Title'"
                                placeholder="Title" value="{{ isset($details['title']) ? $details['title'] : old('title') }}">
                            @if($errors->has('title'))
                            <label for="email" class="error">{{ $errors->first('title') }}</label>
                            @endif
                        </div>

                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                            <input class="form-control valid" name="experience" id="experience" type="number"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Experience'"
                                placeholder="Experience" value="{{ isset($details['experience']) ? $details['experience'] : old('experience') }}">
                            @if($errors->has('experience'))
                            <label for="experience" class="error">{{ $errors->first('experience') }}</label>
                            @endif
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="description" id="description" type="text"
                                onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Description'" placeholder="Description"
                                value="{{ isset($details['description']) ? $details['description'] : old('description') }}">
                            @if($errors->has('description'))
                            <label for="description" class="error">{{ $errors->first('description') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="skils" id="skils" type="text"
                                onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter Skils With comma(,) Saparation'" placeholder="Skils"
                                value="{{ isset($details['skils']) ? $details['skils'] : old('skils') }}">
                            <label>Comma(,) Saparation</label>
                            @if($errors->has('skils'))
                            <label for="skils" class="error">{{ $errors->first('skils') }}</label>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="button button-contactForm boxed-btn">{{$details['id'] ? 'Edit Post' : 'Add Post'}}</button>
                </div>

            </form>
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>

@endsection