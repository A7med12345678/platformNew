@extends('layouts.adminApp')
@section('title', 'Complains : ' . $Global_platFormName)
@section('styles')
<link href="{{ asset('admin-css/showAllData-part.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Content Start -->
<div class="content-child">

    <!-- Navbar Start -->
    <div class="container p-3 pt-5">


        <h1>Courses Requests Manager : </h1>

        @include('components.flashMsg')

        <a href="{{ route('admin/courseBuyRequests') }}" class="btn btn-success m-3">
            <i class="fas fa-users me-2"></i>All Comlains
        </a>
        <br>

        <label for="sort" class="mb-2 mt-4">Filter by :</label>
        <form action="{{ route('admin/courseBuyRequests') }}" method="GET">

            <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                <!-- all grades -->
                <optgroup label="Grades">
                    <option value="1" {{ request('sort') === '1' ? ' selected' : '' }}>Grade 1</option>
                    <option value="2" {{ request('sort') === '2' ? ' selected' : '' }}>Grade 2</option>
                    <option value="3" {{ request('sort') === '3' ? ' selected' : '' }}>Grade 3</option>
                    <option value="guest" {{ request('sort') === 'guest' ? ' selected' : '' }}>Guests</option>
                </optgroup>
            </select>
        </form>
        <div class="form-group mt-4 mb-4">
            <label for="search" class="mb-2">Search :</label>
            <div class="input-group">
                <input id="search" type="text" class="form-control" placeholder="ahmed , 567 , 01111111111 ..">
                <div class="input-group-append">
                    <span class="input-group-text">&#128269;</span>
                </div>
            </div>
        </div>

        <div class="mb-5">
            {{-- Current Filter Number : <span class="text-danger h5" style="font-weight:bold;">{{ $currentCount }}</span> --}}
        </div>

        <div class="table-responsive pl-3 pr-3 " id="table">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>#</th>
                        <th>Action</th>
                        <th>Code</th>
                        <th>Student Id</th>
                        <th>Student Name</th>
                        <th>Notify</th>
                        <th>Course</th>
                        <th>Mail</th>
                        <th>Phone</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($requests)
                    @forelse ($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>
                            <a href="{{ route('deleteRequestCourseAdmin', $request->id) }}" title="Edit Student">
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </a>
                        </td>
                        <td>{{ $request->request_code }}</td>
                        <td class="p-2">
                            <form action="{{ url('statusCourseRequest/' . $request->student_code . '/' . $request->course) }}" method="POST">
                                @csrf
                                @method('POST')
                                <select name="action" class="form-control" onchange="this.form.submit()">
                                    <option value="0" {{ $request->status === '0' ? 'selected' : '' }}>Seen</option>
                                    <option value="1" {{ $request->status === '1' ? 'selected' : '' }}>Pending</option>
                                    <option value="2" {{ $request->status === '2' ? 'selected' : '' }}>Approve</option>
                                </select>
                            </form>
                        </td>
                        <td @if ($request->student_code == 0) colspan="2" @endif>
                            @if ($request->student_code == 0)
                            <span class="text-warning" style="font-weight: bold;">
                                Guest
                            </span>
                            @else
                            {{ $request->student_code }}
                            @endif
                        </td>
                        @if ($request->student_code != 0 && isset($request->user_details->name))
                        <td>
                            {{ $request->user_details->name }}
                        </td>
                        @endif
                        <td>
                            @if($request->status != '2')
                            <a class="btn btn-success text-center mx-auto" style="font-weight:bold;" target="_blank" href="https://wa.me/+2{{ $request->user_details->whatsapp ?? $request->phone }}?text=%D8%A7%D9%84%D8%B1%D8%AC%D8%A7%D8%A1%20%D8%AA%D8%B3%D8%AF%D9%8A%D8%AF%20%D9%85%D8%A7%20%D8%AA%D8%A8%D9%82%D9%89%20%D9%85%D9%86%20%D9%85%D8%B5%D8%B1%D9%88%D9%81%D8%A7%D8%AA%20%D8%AF%D9%88%D8%B1%D8%A9%20{{ Auth::user()->grade }}%20%D8%AD%D8%AA%D9%89%20%D9%8A%D8%AA%D9%85%20%D8%A5%D8%AA%D8%A7%D8%AD%D8%AA%D9%87%D8%A7%2C%0A%D9%85%D8%B9%20%D8%AA%D8%AD%D9%8A%D8%A7%D8%AA%20%D9%85%D9%86%D8%B5%D8%A9%20{{ $Global_platFormName }}%20..">
                                <i class="fab fa-whatsapp"></i>
                                Notify
                            </a>
                            <br>
                            <a class="btn btn-primary text-center mx-auto mt-3" href="{{ route('mailCoursePayment', $request->user_details->id ?? $request->email) }}">
                                <i class="fas fa-envelope"></i> Notify
                            </a>

                            @else
                            <span class="text-danger"> User Paid ! </span>
                            @endif
                        </td>
                        <td>{{ $request->course }}</td>
                        <td>
                            {{ $request->user_details->email  ?? $request->email}}
                        </td>
                        <td>
                            {{ $request->user_details->whatsapp  ?? $request->phone}}

                        </td>
                        <td>{{ $request->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="p-3">No Complains found.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
        @endisset


    </div>

</div>
@endsection

@section('js')
<script src="{{ asset('admin-js/searchJquery.js') }}"></script>
@endsection
