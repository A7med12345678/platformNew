@extends('layouts.adminApp')
@section('title', 'Show Exam : ' . $Global_platFormName)

@section('content')

    <div class="container p-5">

        <div class="answers">
            <h1 class="mt-3">Show Assesment Details : </h1>

            <form method="POST" class="mb-5" id="upload-form">
                @csrf

                <div class="form-group">
                    <select class="form-control" id="gradeSec" name="gradeSec">
                        @include('components.gradeChoose')
                    </select>
                </div>

                @include('components.examOrHw')

                <button type="submit" class="btn btn-success mt-4">Show</button>

            </form>

        </div>


        <hr class="mt-5">

        <div class="questions">

            <h1 class="mt-5">Show Assesment Questions : </h1>

            <form method="POST" id="upload-form2">
                @csrf

                <div class="form-group">
                    <select class="form-control" id="gradeSec2" name="gradeSec2">
                        @include('components.gradeChoose')
                    </select>
                </div>

                @include('components.examOrHw')

                <button type="submit" class="btn btn-success mt-4">Show</button>

            </form>
        </div>

    </div>

@endsection


@section('js')
    {{-- route variables :  --}}
    <script>
        var examShow_Questions = "{{ route('admin/examShow/Questions') }}";
        var HWShow_Questions = "{{ route('admin/HWShow/Questions') }}";

        var examShow_details = "{{ route('admin/examShow/details') }}";
        var HWShow_details = "{{ route('admin/HWShow/details') }}";
    </script>

    {{-- form submittion : --}}
    <script src="{{ asset('jquery/assesmentShow/show.js') }}"></script>
    <script src="{{ asset('jquery/assesmentShow/showDetails.js') }}"></script>
@endsection
