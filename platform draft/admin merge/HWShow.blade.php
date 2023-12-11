@extends('layouts.adminApp')
@section('title', 'Show HW : ' . $Global_platFormName)

@section('content')

    <div class="container p-5">

        <h1 class="mt-3">Show Home Work Details : </h1>

        <form method="POST" action="{{ route('admin/HWShow/showExams') }}" class="mb-5">
            @csrf

            <div class="form-group">
                <select class="form-control" id="section-selector" name="grade">
                    <option value="1">1 Sec.</option>
                    <option value="2">2 Sec.</option>
                    <option value="3">3 Sec.</option>
                </select>
            </div>


            <button type="submit" class="btn btn-success mt-4">Show</button>

        </form>



        <hr class="mt-5">

        <h1 class="mt-5">Show Home Work Questions : </h1>

        <form method="POST" action="{{ route('admin/HWShow/showHWPhoto') }}">
            @csrf

            <div class="form-group">
                <select class="form-control" id="section-selector" name="grade">
                    <option value="1">1 Sec.</option>
                    <option value="2">2 Sec.</option>
                    <option value="3">3 Sec.</option>
                </select>
            </div>


            <button type="submit" class="btn btn-success mt-4">Show</button>

        </form>

    </div>

@endsection
