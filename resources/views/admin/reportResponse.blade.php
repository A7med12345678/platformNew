@extends('layouts.adminApp')
@section('title', 'Report Exam : ' . $Global_platFormName)
@section('content')

    <!-- Content Start -->
    <div class="p-5">
        <div class="container">

            <div class="h3 text-right">Report Action : </div>
            @include('components.flashMsg')

                <div class="response">
                    @include('components.reportMsg')
                </div>
                
                <hr>
                
                <!-- Blade view file -->
                    <a href="{{route('admin/report') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                     <!--url()->previous()-->

        </div>

    </div>
@endsection
