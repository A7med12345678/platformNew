@extends('layouts.adminApp')
@section('title', 'Student Manager : ' . $Global_platFormName)
@section('content')
    <!-- Content Start -->
    <div class="content-child">
        <!-- Navbar Start -->
        <div class="container p-3 pt-5">
            @if (session('flash_msg'))
                <div class="container">
                    <div class="alert alert-success mt-3" id="flash-msg">
                        {{ session('flash_msg') }}
                    </div>
                </div>
            @endif
            <h1>Activation Manager</h1>

            <form action="{{ route('Admin/showAllActivations') }}" method="GET" class="mt-4">
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
                        <!-- pay - all grades -->
                        <optgroup label="Pay - Grades">
                            <option value="pay1" {{ request('sort') === 'pay1' ? ' selected' : '' }}>Pay - 1 Sec</option>
                        <option value="pay2" {{ request('sort') === 'pay2' ? ' selected' : '' }}>Pay - 2 Sec</option>
                        <option value="pay3" {{ request('sort') === 'pay3' ? ' selected' : '' }}>Pay - 3 Sec</option>
                        </optgroup>
                        <!-- no pay - all grades -->
                        <optgroup label="No Pay - Grades">
                            <option value="nopay1" {{ request('sort') === 'nopay1' ? ' selected' : '' }}>No pay - 1 Sec
                            </option>
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
                        {{-- type - grades --}}
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
                        {{-- type - pay - all grades --}}
                        <optgroup label="Type, Pay - All Grades">
                            <option value="typegradeGENERALpay"
                                {{ request('sort') === 'typegradeGENERALpay' ? ' selected' : '' }}>General Pay</option>
                            <option value="typegradeAZHARpay"
                                {{ request('sort') === 'typegradeAZHARpay' ? ' selected' : '' }}>Azhar Pay</option>
                        </optgroup>
                        {{-- type - no pay - all grades --}}
                        <optgroup label="Type, No Pay - All Grades">
                            <option value="typegradeGENERALnopay"
                                {{ request('sort') === 'typegradeGENERALnopay' ? ' selected' : '' }}>General no Pay
                            </option>
                            <option value="typegradeAZHARnopay"
                                {{ request('sort') === 'typegradeAZHARnopay' ? ' selected' : '' }}>Azhar no Pay</option>
                        </optgroup>
                        {{-- type - pay - grades --}}
                        <optgroup label="Type, Pay - Grades">
                            <option value="typegradeGENERAL1pay"
                                {{ request('sort') === 'typegradeGENERAL1pay' ? ' selected' : '' }}>General 1 Pay</option>
                            <option value="typegradeGENERAL2pay"
                                {{ request('sort') === 'typegradeGENERAL2pay' ? ' selected' : '' }}>General 2 Pay</option>
                            <option value="typegradeGENERAL3pay"
                                {{ request('sort') === 'typegradeGENERAL3pay' ? ' selected' : '' }}>General 3 Pay</option>
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
                        {{-- type - no pay - grades --}}
                        <optgroup label="Type, Pay - Grades">
                            <option value="typegradeGENERAL1nopay"
                                {{ request('sort') === 'typegradeGENERAL1nopay' ? ' selected' : '' }}>General 1 no Pay
                            </option>
                            <option value="typegradeGENERAL2nopay"
                                {{ request('sort') === 'typegradeGENERAL2nopay' ? ' selected' : '' }}>General 2 no Pay
                            </option>
                            <option value="typegradeGENERAL3nopay"
                                {{ request('sort') === 'typegradeGENERAL3nopay' ? ' selected' : '' }}>General 3 no Pay
                            </option>
                        <optgroup label="Type, Pay - Grades">
                            <option value="typegradeAZHAR1nopay"
                                {{ request('sort') === 'typegradeAZHAR1nopay' ? ' selected' : '' }}>Azhar 1 no Pay</option>
                            <option value="typegradeAZHAR2nopay"
                                {{ request('sort') === 'typegradeAZHAR2nopay' ? ' selected' : '' }}>Azhar 2 no Pay</option>
                            <option value="typegradeAZHAR3nopay"
                                {{ request('sort') === 'typegradeAZHAR3nopay' ? ' selected' : '' }}>Azhar 3 no Pay</option>
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
                    </select>
                </div>
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

            <div class="mb-4">
                Current Filter Number : <span class="text-danger h5" style="font-weight:bold;">{{ $currentCount }}</span>
            </div>

            <form method="POST" action="{{ route('Admin/manageActivations') }}" id="studentForm"
                onsubmit="return confirm('Are you sure you want to Activate / De-Active selecteds student?');">
                @csrf
                <div class="table-responsive pl-3 pr-3" id="table">

                    {{-- form : --}}
                    <div class="form m-3">
                        <button type="submit" class="btn btn-success m-3 text-left" name="action"
                            value="activate">Submit</button>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="activate" id="activateOption"
                                value="1" checked>
                            <label class="form-check-label" for="activateOption">Activate</label>
                        </div>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="activate" id="deactivateOption"
                                value="0">
                            <label class="form-check-label" for="deactivateOption">Deactivate</label>
                        </div>
                    </div>

                    {{-- content table : --}}
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <table class="table table-responsive text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th><input type="checkbox" id="checkAll"></th> <!-- Add a "Select All" checkbox -->
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Pay</th>
                                    <!-- <th>Status</th> -->
                                    <th>Type</th>
                                    <th>Email</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($current)
                                    @foreach ($current as $item)
                                        <tr>
                                            <td class="p-2"
                                                style="{{ $item->pay === '1' ? 'border: 1px solid red;' : '' }}">
                                                <input type="checkbox" name="center_codes[]"
                                                    value="{{ $item->center_code }}"
                                                    id="center_code_{{ $item->center_code }}">
                                            </td>

                                            <td>{{ $item->center_code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <span class="{{ $item->pay === '1' ? 'text-success' : 'text-danger' }}">
                                                    {{ $item->pay === '1' ? 'Paied' : 'not paied' }}
                                                </span>
                                            </td>
                                            <td>{{ $item->learn_type }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->grade }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin-js/activationManager.js') }}"></script>
@endsection
