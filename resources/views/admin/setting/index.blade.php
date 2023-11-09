@extends('admin.layouts.main')

@section('content')

 
<div class="intro-y col-span-12 lg:col-span-6 mt-5">
    <!-- BEGIN: Vertical Form -->
    {{-- <div class="intro-y box">
        
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="intro-y text-lg font-medium mt-10">
                Setting
            </h2>
        </div> --}}
     
            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ route('setting.update') }}" enctype="multipart/form-data">

            @csrf


{{--@dd($errors->has('title'));--}}
<div class="intro-y box mt-5">
 
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">
            Setting
        </h2>
       
    </div>

    @if(session('success'))
    <div class="alert alert-primary text-center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
    @endif

    <div id="inline-form" class="p-5">
        <div class="preview">
            <div class="grid grid-cols-12 gap-2">
                <label  class="form-label col-span-6">Title En</label>
                <label  class="form-label col-span-6">Title Ar</label>
                <input type="text" class="form-control col-span-6"  aria-label="default input inline 1" name="title_en" value="{{$setting->title_en}}">
                <input type="text" class="form-control col-span-6"  aria-label="default input inline 2" name="title_ar" value="{{$setting->title_ar}}">
                @error('title_en')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
                @error('title_ar')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
            </div>
            <div class="grid grid-cols-12 gap-2 mt-3">
                <label  class="form-label col-span-6">Description En</label>
                <label  class="form-label col-span-6">Description Ar</label>
                <textarea class="form-control col-span-6" aria-label="default input inline 1" name="description_en"> {{$setting->description_en}}</textarea>
                <textarea class="form-control col-span-6" aria-label="default input inline 2" name="description_ar"> {{$setting->description_ar}}</textarea>
                @error('description_en')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
                @error('description_ar')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
            </div>
            <div class="grid grid-cols-12 gap-2 mt-3">
                <label  class="form-label col-span-6">Keywords En</label>
                <label  class="form-label col-span-6">Keywords Ar</label>
                <textarea class="form-control col-span-6" aria-label="default input inline 1" name="keyword_en"> {{$setting->keyword_en}}</textarea>
                <textarea class="form-control col-span-6" aria-label="default input inline 2" name="keyword_ar"> {{$setting->keyword_ar}}</textarea>
                @error('keyword_en')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
                @error('keyword_ar')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
            </div>

            <div class="grid grid-cols-12 gap-2 mt-3">
                <label  class="form-label col-span-6">Logo</label>
                <label  class="form-label col-span-6">Main Image</label>
                <input type="file" class="form-control col-span-6"  aria-label="default input inline 1" name="logo">
                <input type="file" class="form-control col-span-6"  aria-label="default input inline 2" name="main_image">
                @error('logo')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
                @error('main_image')
                <div class="error col-span-6">{{ $message }}</div>
                @else
                <div class="error col-span-6"></div>
                @enderror
                <img alt="Midone - HTML Admin Template" class="col-span-6" src="{{asset('storage/'.$setting->logo)}}">
                <img alt="Midone - HTML Admin Template" class="col-span-6" src="{{asset('storage/'.$setting->main_image)}}">
            </div>

            <button class="btn btn-primary mt-5">{{__('Submit')}}</button>


        </div>
        <div class="source-code hidden">
            <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file" data-lucide="file" class="lucide lucide-file w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> Copy example code </button>
            <div class="overflow-y-auto mt-3 rounded-md">
                <pre id="copy-inline-form" class="source-preview"> <code class="html hljs xml"> <span class="hljs-tag">&lt;<span class="hljs-name">div</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"grid grid-cols-12 gap-2"</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">input</span> <span class="hljs-attr">type</span>=<span class="hljs-string">"text"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-control col-span-4"</span> <span class="hljs-attr">placeholder</span>=<span class="hljs-string">"Input inline 1"</span> <span class="hljs-attr">aria-label</span>=<span class="hljs-string">"default input inline 1"</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">input</span> <span class="hljs-attr">type</span>=<span class="hljs-string">"text"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-control col-span-4"</span> <span class="hljs-attr">placeholder</span>=<span class="hljs-string">"Input inline 2"</span> <span class="hljs-attr">aria-label</span>=<span class="hljs-string">"default input inline 2"</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">input</span> <span class="hljs-attr">type</span>=<span class="hljs-string">"text"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-control col-span-4"</span> <span class="hljs-attr">placeholder</span>=<span class="hljs-string">"Input inline 3"</span> <span class="hljs-attr">aria-label</span>=<span class="hljs-string">"default input inline 3"</span>&gt;</span> <span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span></code> <textarea class="absolute w-0 h-0 p-0"></textarea></pre>
            </div>
        </div>
    </div>
</div>
       
</div>
    </form>


</div>
@endsection
