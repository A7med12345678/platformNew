@extends('layouts.adminApp')
@section('title', 'Admin Manager : ' . $Global_platFormName)
@section('styles')
{{-- <link href="{{ asset('admin-css/adminManager-part.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')

<!-- Content Start -->
<div class="container">
    <div class="container pt-5">

        @include('components.flashMsg')

        <h1 class="text-primary  mt-5">Admin List</h1>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>#</th>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>
                            <div class="text-center mt-4">
                                <form action="{{ route('deleteAdmin', $admin->id) }}" onsubmit="return confirm('Are you sure you want to Promote / Demote this admin?');">
                                    @csrf
                                    <button type="submit" class="btn bg-warning text-white">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="text-center mt-4">
                                <form action="{{ route('pormoteAdmin', $admin->center_code) }}" onsubmit="return confirm('Are you sure you want to Promote / Demote this admin?');">
                                    @csrf
                                    <button type="submit" class="btn @if ($admin->role === 'admin') bg-success @else bg-danger @endif">
                                        @if ($admin->role === 'admin')
                                        <span class="text-white">Promote</span>
                                        @else
                                        <span class="text-white">Demote</span>
                                        @endif
                                    </button>
                                </form>

                            </div>
                        </td>
                        <td class="text-danger font-weight-bold">{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td style="font-weight: bold;">{{ $admin->role === 'Sadmin' ? 'Super Admin' : 'Admin' }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>



@endsection
