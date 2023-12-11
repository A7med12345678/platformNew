@extends('layouts.adminApp')
@section('title', 'Preview : ' . $Global_platFormName)


@section('content')

 <!-- Content Start -->

             <!--Admin Dashboard : -->
            <div class="mt-5 mb-5 text-center">
                    <a href="{{ route('admin/AssesmantShow') }}" class="btn btn-warning text-white">
                    &#8592; Go Home
                </a>
            </div>

         <div class="container p-5 pt-2">
        {{-- <img src="{{ asset('storage/1/x1/x.png') }}" alt="Photo"> --}}

        {{-- <img src="{{asset('public/storage/test.png')}}" alt=""> --}}
        @foreach (Storage::directories('public/photos/' . $grade) as $subfolder)
        <h2 class="mt-5"> {{ substr(basename($subfolder), 0, -4) }} Exam : </h2>
        <div class="row">
                @foreach (Storage::files($subfolder) as $photo)
                    <div class="col-6 p-3">
                        <img width="100%" height="100%" src="{{ asset('storage/photos/' . $grade . str_replace('public/photos/' . $grade, '', $photo)) }}" alt="Photo">
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

@endsection
