@extends('layouts.welcomeApp')
@section('title', 'Free Content : ' . $Global_platFormName)

@section('styles')
    <link href="{{ asset('welcome/css/videoFreeContent.css') }}" rel="stylesheet">
@endsection

@section('page-content')

    <div class="m-5">
        <div id="video-container">

            <h2 class="mb-4" style="text-align: right; font-family:Marhey;">
                :  المحتوى المجاني
            </h2>

            <form action="{{ route('FreeContent') }}" method="GET" class="mt-4">
                <div class="form-group">
                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                        <optgroup>
                            <option value="2" {{ request('sort') === '2' ? ' selected' : '' }} dir="rtl">الصف
                                الثاني الثانوي</option>
                            <option value="3" {{ request('sort') === '3' ? ' selected' : '' }} dir="rtl">الصف
                                الثالث الثانوي</option>
                            </option>
                        </optgroup>

                    </select>
                </div>
            </form>

            @forelse ($videoData as $video)
                <div class="row">
                    <div class="video-wrapper text-center m-5 col-11 mx-auto text-center">
                        <h3 class="video-title">{{ $video['title'] }}</h3>
                        <iframe class="video-frame" width="90%" height="500" src="{{ $video['url'] }}" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            @empty
                <div class="text-danger text-center p-5 h2">
                    {{-- No videos now ! --}}
                    لا يوجد فيديوهات لعرضها الآن
                </div>
            @endforelse
        </div>
    </div>



@endsection
