@php
use App\Helpers\MediaValidationHelper;
@endphp
@extends('layouts.students.studentApp')
@section('title', 'Course Buy - Student')


@section('content')
<div class="container mt-5 p-5">
    <div class="h2 mb-5">Course Videos Download : </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Download Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Storage::files('public/videos/' . Auth::user()->grade) as $file)
            <tr>
                <td>{{ MediaValidationHelper::formatFileName(basename($file)) }}</td>
                <td><a href="{{ asset('storage/videos/' . Auth::user()->grade . '/' . basename($file)) }}">Download File</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
