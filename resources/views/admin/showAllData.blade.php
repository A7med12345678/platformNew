@extends('layouts.adminApp')
@section('title', 'Student Manager : ' . $Global_platFormName)
@section('styles')
    <link href="{{ asset('admin-css/showAllData-part.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Start -->
    <div class="content-child">

        <div class="container p-3 pt-5">


            <h1>Students Manager</h1>

            @include('components.flashMsg')

            <a href="{{ route('Admin/showAll') }}"
                class="btn btn-success m-3 {{ Request::is('Admin/showAll') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i>All Students
            </a>

            {{-- filter : --}}
            <form action="{{ route('Admin/showAll') }}" method="GET" class="mt-4">
                <div class="form-group">
                    <label for="sort" class="mb-2">Filter by :</label>
                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                        <!-- all grades -->
                        <option value="allWithAdmin" {{ request('sort') === 'allWithAdmin' ? ' selected' : '' }}>All With
                            Admins</option>
                        <optgroup label="Grades">
                            <option value="all" {{ !request('sort') || request('sort') === 'all' ? ' selected' : '' }}>
                                Default</option>
                            <!--<option value="1" {{ request('sort') === '1' ? ' selected' : '' }}>Grade 1</option>-->
                            <option value="2" {{ request('sort') === '2' ? ' selected' : '' }}>Grade 2</option>
                            <option value="3" {{ request('sort') === '3' ? ' selected' : '' }}>Grade 3</option>
                        </optgroup>
                        {{-- <optgroup label="Status">
                            <option value="online" {{ request('sort') === 'online' ? ' selected' : '' }}>Online </option>
                            <option value="offline" {{ request('sort') === 'offline' ? ' selected' : '' }}>Offline</option>
                        </optgroup> --}}
                        <!-- pay - all grades -->
                        <optgroup label="Pay - Grades">
                            <!--<option value="pay1" {{ request('sort') === 'pay1' ? ' selected' : '' }}>Pay - 1 Sec</option>-->
                            <option value="pay2" {{ request('sort') === 'pay2' ? ' selected' : '' }}>Pay - 2 Sec</option>
                            <option value="pay3" {{ request('sort') === 'pay3' ? ' selected' : '' }}>Pay - 3 Sec</option>
                        </optgroup>
                        <!-- block - all grades -->
                        <optgroup label="Blocked - Grades">
                            <!--<option value="block1" {{ request('sort') === 'block1' ? ' selected' : '' }}>Blocked - 1 Sec-->
                            <!--</option>-->
                            <option value="block2" {{ request('sort') === 'block2' ? ' selected' : '' }}>Blocked - 2 Sec
                            </option>
                            <option value="block3" {{ request('sort') === 'block3' ? ' selected' : '' }}>Blocked - 3 Sec
                            </option>
                        </optgroup>
                        <!-- no pay - all grades -->
                        <optgroup label="No Pay - Grades">
                            <!--<option value="nopay1" {{ request('sort') === 'nopay1' ? ' selected' : '' }}>No pay - 1 Sec-->
                            <!--</option>-->
                            <option value="nopay2" {{ request('sort') === 'nopay2' ? ' selected' : '' }}>No pay - 2 Sec
                            </option>
                            <option value="nopay3" {{ request('sort') === 'nopay3' ? ' selected' : '' }}>No pay - 3 Sec
                            </option>
                        </optgroup>
                        <!-- pay - no pay -->
                        <optgroup label="Pay - All Grades">
                            <option value="pay" {{ request('sort') === 'pay' ? ' selected' : '' }}>Pay</option>
                            <option value="nopay" {{ request('sort') === 'nopay' ? ' selected' : '' }}>Not Paid</option>
                        </optgroup>
                        <!-- type -->
                        <optgroup label="Type - All Grades">
                            <option value="typegradeGENERAL" {{ request('sort') === 'pay' ? ' selected' : '' }}>General
                            </option>
                            <option value="typegradeAZHAR" {{ request('sort') === 'typegradeAZHAR' ? ' selected' : '' }}>
                                Azhar</option>
                        </optgroup>
                        {{-- type - grades  --}}
                        <optgroup label="Type - Grades">
                            <option value="typegradeGENERAL1"
                                {{ request('sort') === 'typegradeGENERAL1' ? ' selected' : '' }}>General 1</option>
                            <option value="typegradeGENERAL2"
                                {{ request('sort') === 'typegradeGENERAL2' ? ' selected' : '' }}>General 2</option>
                            <option value="typegradeGENERAL3"
                                {{ request('sort') === 'typegradeGENERAL3' ? ' selected' : '' }}>General 3</option>
                            <option value="typegradeAZHAR1" {{ request('sort') === 'typegradeAZHAR1' ? ' selected' : '' }}>
                                Azhar 1</option>
                            <option value="typegradeAZHAR2" {{ request('sort') === 'typegradeAZHAR2' ? ' selected' : '' }}>
                                Azhar 2</option>
                            <option value="typegradeAZHAR3" {{ request('sort') === 'typegradeAZHAR3' ? ' selected' : '' }}>
                                Azhar 3</option>
                        </optgroup>
                        {{-- type - pay - all grades  --}}
                        <optgroup label="Type, Pay - All Grades">
                            <option value="typegradeGENERALpay"
                                {{ request('sort') === 'typegradeGENERALpay' ? ' selected' : '' }}>
                                General Pay</option>
                            <option value="typegradeAZHARpay"
                                {{ request('sort') === 'typegradeAZHARpay' ? ' selected' : '' }}>Azhar Pay</option>
                        </optgroup>
                        {{-- type - no pay - all grades  --}}
                        <optgroup label="Type, No Pay - All Grades">
                            <option value="typegradeGENERALnopay"
                                {{ request('sort') === 'typegradeGENERALnopay' ? ' selected' : '' }}>
                                General no Pay
                            </option>
                            <option value="typegradeAZHARnopay"
                                {{ request('sort') === 'typegradeAZHARnopay' ? ' selected' : '' }}>
                                Azhar no Pay</option>
                        </optgroup>
                        {{-- type - pay - grades  --}}
                        <optgroup label="Type, Pay - Grades">
                            <option value="typegradeGENERAL1pay"
                                {{ request('sort') === 'typegradeGENERAL1pay' ? ' selected' : '' }}>
                                General 1 Pay</option>
                            <option value="typegradeGENERAL2pay"
                                {{ request('sort') === 'typegradeGENERAL2pay' ? ' selected' : '' }}>
                                General 2 Pay</option>
                            <option value="typegradeGENERAL3pay"
                                {{ request('sort') === 'typegradeGENERAL3pay' ? ' selected' : '' }}>
                                General 3 Pay</option>
                        </optgroup>
                        </optgroup>
                        <optgroup label="Type, Pay - Grades">
                            <option value="typegradeAZHAR1pay"
                                {{ request('sort') === 'typegradeAZHAR1pay' ? ' selected' : '' }}>Azhar 1 Pay</option>
                            <option value="typegradeAZHAR2pay"
                                {{ request('sort') === 'typegradeAZHAR2pay' ? ' selected' : '' }}>Azhar 2 Pay</option>
                            <option value="typegradeAZHAR3pay"
                                {{ request('sort') === 'typegradeAZHAR3pay' ? ' selected' : '' }}>Azhar 3 Pay</option>
                        </optgroup>
                        {{-- type - no pay - grades  --}}
                        <optgroup label="Type, Pay - Grades">
                            <option value="typegradeGENERAL1nopay"
                                {{ request('sort') === 'typegradeGENERAL1nopay' ? ' selected' : '' }}>
                                General 1 no Pay
                            </option>
                            <option value="typegradeGENERAL2nopay"
                                {{ request('sort') === 'typegradeGENERAL2nopay' ? ' selected' : '' }}>
                                General 2 no Pay
                            </option>
                            <option value="typegradeGENERAL3nopay"
                                {{ request('sort') === 'typegradeGENERAL3nopay' ? ' selected' : '' }}>
                                General 3 no Pay
                            </option>
                        <optgroup label="Type, Pay - Grades">
                            <option value="typegradeAZHAR1nopay"
                                {{ request('sort') === 'typegradeAZHAR1nopay' ? ' selected' : '' }}>
                                Azhar 1 no Pay</option>
                            <option value="typegradeAZHAR2nopay"
                                {{ request('sort') === 'typegradeAZHAR2nopay' ? ' selected' : '' }}>
                                Azhar 2 no Pay</option>
                            <option value="typegradeAZHAR3nopay"
                                {{ request('sort') === 'typegradeAZHAR3nopay' ? ' selected' : '' }}>
                                Azhar 3 no Pay</option>
                        </optgroup>
                        <optgroup label="Deleted - Grades">
                            <option value="allDeleted" {{ request('sort') === 'allDeleted' ? ' selected' : '' }}>All
                                Deleted</option>
                            <option value="deleted1" {{ request('sort') === 'deleted1' ? ' selected' : '' }}>Deleted 1
                            </option>
                            <option value="deleted2" {{ request('sort') === 'deleted2' ? ' selected' : '' }}>Deleted 2
                            </option>
                            <option value="typegradeAZHAR2pay" {{ request('sort') === 'deleted3' ? ' selected' : '' }}>
                                Deleted 3</option>
                        </optgroup>
                        <optgroup label="Profile">
                            <option value="profile" {{ request('sort') === 'profile' ? ' selected' : '' }}>All
                                Has Profile</option>
                        </optgroup>
                    </select>
                </div>
            </form>

            {{-- search : --}}
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
                Current Filter Number : <span class="text-danger h5" style="font-weight:bold;">{{ $currentCount }}</span>
            </div>

            <div class="table-responsive pl-3 pr-3 " id="table">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Pay </th>
                            {{-- <th>Status</th> --}}
                            <th>Type</th>
                            <th>Block </th>
                            <th>email</th>
                            <th>grade</th>
                            <th>Mobile</th>
                            <th>Parent Mobile</th>
                            <th>WhatsApp Mobile</th>
                            <th>Role </th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($current)
                            @forelse ($current as $item)
                                <tr>

                                    <td class="p-2">

                                        @if ($item->deleted_at != null)
                                            <span class="text-danger">Student Already Deleted !</span>
                                        @else
                                            <div class="">
                                                @if (Auth::user()->center_code === '1001' ||
                                                        Auth::user()->center_code === '2001' ||
                                                        Auth::user()->center_code === '3001')
                                                    <div class="">
                                                        <form method="POST"
                                                            action="{{ route('admin/destroyStudent', $item->center_code) }}"
                                                            accept-charset="UTF-8" style="display:inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                            @csrf
                                                            @method('GET')
                                                            <button type="submit" class="btn btn-danger pl-2 pr-2"
                                                                title="Delete Student">Delete</button>
                                                        </form>
                                                    </div>
                                                    <br>
                                                @endif
                                            </div>

                                            <div class="text-center">
                                                <a href="{{ route('admin/editStudentPage', $item->center_code) }}"
                                                    title="Edit Student">
                                                    <button class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                </a>
                                            </div>

                                            <div class="text-center mt-4">
                                                <form method="POST" action="{{ route('admin/forceStopManager') }}"
                                                    onsubmit="return confirm('Are you sure you want to Ban / Un-Ban this student?');">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->center_code }}">
                                                    <button type="submit" class="btn btn-warning">
                                                        @if ($item->force_stop === '1')
                                                            <span style="font-size:smaller;">Un-Ban</span>
                                                        @else
                                                            Ban
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="text-center mt-4">
                                                <form method="POST" action="{{ route('admin/activationStopManager') }}"
                                                    onsubmit="return confirm('Are you sure you want to Active / De-activate this student?');">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->center_code }}">
                                                    <button type="submit" class="btn btn-success">
                                                        @if ($item->pay === '1')
                                                            <span style="font-size:10px;">De-Active</span>
                                                        @else
                                                            Activate
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>

                                            @if (Auth::user()->center_code !== '1001' &&
                                                    Auth::user()->center_code !== '2001' &&
                                                    Auth::user()->center_code !== '3001')
                                                @if ($item->role === 'admin')
                                                    <div class="text-danger text-center">Permission Denied !</div>
                                                @else
                                                    <div class="">
                                                        <form method="POST"
                                                            action="{{ route('admin/destroyStudent', $item->center_code) }}"
                                                            accept-charset="UTF-8" style="display:inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger pl-2 pr-2"
                                                                title="Delete Student">Delete</button>
                                                        </form>
                                                    </div>
                                                    <br>
                </div>
                @endif
                @endif
                @endif

                </td>
                <td>{{ $item->center_code }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    @if ($item->profile_photo)
                        <img src="{{ asset('storage/profiles/' . $item->profile_photo) }}" alt="" width="100"
                            height="100" class="rounded-circle">
                    @else
                        <img src="{{ asset('welcome/images/null.webp') }}" alt="no repsonse logo" width="100"
                            height="100">
                    @endif
                </td>

                <td>
                    <span class="{{ $item->pay === '1' ? 'text-success' : 'text-danger' }}">
                        {{ $item->pay === '1' ? 'Paied' : 'not paied' }}
                    </span>
                </td>
                <td>{{ $item->learn_type }}</td>
                <td>{{ $item->force_stop }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->grade }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->parent_phone }}</td>
                <td>{{ $item->whatsapp }}</td>
                <td>{{ $item->role }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="p-3">No Students found.</td>
                </tr>
                @endforelse

                </tbody>
                </table>

            </div>
        @endisset


    </div>

    </div>
@endsection
