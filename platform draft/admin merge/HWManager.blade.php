@extends('layouts.adminApp')
@section('title', 'Reset HW : ' . $Global_platFormName)

@section('content')

        <div class="container p-3 pt-5">
            <h1>Home Work Manager</h1>

            @include('components.flashMsg')

            <div class="h3 mt-5 mb-3 text-primary">Enable Homw Work Again</div>
            <form id="upload-form" action="{{ route('quiz/enable-HW') }}" method="POST" class="form-inline">
                @csrf
                <div class="form-group mx-sm-3 m-3">
                    <label for="id" class="sr-only">ID</label>
                    <input type="text" class="form-control" id="id" name="id" placeholder="Enter ID">
                </div>
                <div class="form-group mx-sm-3 m-3">
                    <label for="pay" class="mb-2">Exam :</label>
                    <select class="form-control" id="section-selector" name="selected_HW">
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            @php
                                $section = 'week' . $week . 'sec3';
                            @endphp
                            <option value="{{ $section }}">HW {{ $week }}</option>
                        @endfor
                    </select>

                </div>
                <button type="submit" class="btn btn-primary mb-2">Enable</button>
            </form>

            <br>
            <hr>

            <div class="h3 mt-5 mb-3 text-primary">Disable Exam :</div>

            <form action="{{ route('disableHW') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="grade">For:</label>
                    <select class="form-control" id="grade" name="grade">
                        <option value="1">1 Sec.</option>
                        <option value="2">2 Sec.</option>
                        <option value="3">3 Sec.</option>
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="week">ُExam Selector:</label>
                    <select class="form-control" id="current" name="current">
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="week{{ $week }}sec3h">HW {{ $week }}</option>
                        @endfor
                    </select>
                </div>

            

                <button type="submit" class="btn btn-primary m-3">Stop HW</button>
            </form>



        </div>

    @endsection
