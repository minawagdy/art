@extends('admin.layouts.main')

@section('content')
@include('admin.includes.messages')
    <h2 class="intro-y text-lg font-medium mt-10">
        Slide
    </h2>
    <div class="intro-y col-span-12 lg:col-span-6 mt-5">
        <!-- BEGIN: Vertical Form -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Edit Slide
                </h2>

                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{route('slider.update', $row->id)}}" enctype="multipart/form-data">
                @method('PUT')

                @csrf

            </div>
            {{--@dd($errors->has('title'));--}}
            <div id="vertical-form" class="p-5">
                <div class="preview">
                    <div>
                        <label for="vertical-form-1" class="form-label">Title En</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="title_en" value="{{ $row->title_en }}">
                    </div>
                    @error('title_en')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <label for="vertical-form-1" class="form-label">Title Ar</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="title_ar" value="{{$row->title_ar}}">
                    </div>
                    @error('title_ar')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">Description En</label>
                        <textarea id="vertical-form-2" class="form-control" name="description_en">{{$row->description_en}}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">Description Ar</label>
                        <textarea id="vertical-form-2" class="form-control" name="description_ar">{{$row->description_ar}}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="vertical-form-1" class="form-label">Link</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="link" value="{{$row->link}}">
                    </div>
                    @error('link')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">Image</label>
                        <input id="vertical-form-2" class="form-control" type="file" name="image" >
                    </div>





                        <button class="btn btn-primary mt-5">{{__('Submit')}}</button>
                    </div>

                </div>
            </div>
            <!-- END: Vertical Form -->




        </div>



@endsection

