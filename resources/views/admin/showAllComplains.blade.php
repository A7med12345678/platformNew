@extends('layouts.adminApp')
@section('title', 'Complains : ' . $Global_platFormName)
@section('content')
    <!-- Content Start -->
    <div class="content-child">

        <!-- Navbar Start -->
        <div class="container p-3 pt-5">
            @include('components.flashMsg')

            <h1>Complains Manager</h1>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('done'))
                <div class="alert alert-success text-center">
                    {{ session('done') }}
                </div>
            @endif
            <form action="{{ route('admin/showAllComplains') }}" method="GET" class="mt-4">
                <div class="form-group">
                    <label for="sort" class="mb-2">Filter by :</label>
                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                        <optgroup label="Status">
                            <option value="done" {{ request('sort') === 'done' ? ' selected' : '' }}>Done </option>
                            <option value="notDone" {{ request('sort') === 'notDone' ? ' selected' : '' }}>Not Done
                            </option>
                        </optgroup>

                    </select>
                </div>
            </form>
            <a href="{{ route('admin/showAllComplains') }}"
                class="btn btn-success m-3 {{ Request::is('admin/showAllComplains') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i>All Complains
            </a>

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
                            <th>Aprove</th>
                            <th>Response</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Content</th>
                            <th>Response</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($complains)
                            @forelse ($complains as $complain)
                                <tr>
                                    <td>{{ $complain->id }}</td>
                                    <td class="p-2">
                                        <form class="form-inline" method="POST"
                                            action="{{ route('destroyComplain', $complain->id) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-warning text-white mb-2">Delete</button>
                                        </form>
                                    </td>
                                    <td class="p-2">
                                        <form class="form-inline" method="POST"
                                            action="{{ route('aproveComplain', $complain->id) }}">
                                            @csrf
                                            @if ($complain->aprove == '1')
                                                <button type="submit"
                                                    class="btn btn-danger mb-2 text-white">Disapprove</button>
                                            @elseif($complain->aprove == '0')
                                                <button type="submit" class="btn btn-success mb-2 text-white">Approve</button>
                                            @endif
                                        </form>
                                    </td>
                                    <td class="p-2">
                                        @if ($complain->done === '1')
                                            <div class="text-primary">Has Been done !</div>
                                        @else
                                            <form class="form-inline" method="POST"
                                                action="{{ route('complainDone', $complain->id) }}">
                                                @csrf

                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="inputText" class="sr-only">Text</label>
                                                    <input type="text" name="response" class="form-control" id="inputText"
                                                        value="Done !">
                                                </div>
                                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{ $complain->user_id }}</td>
                                    <td>{{ $complain->user_name }}</td>
                                    <td>{{ $complain->content }}</td>
                                    <td>
                                        <span>
                                            @if ($complain->response === null)
                                                <img src="{{ asset('welcome/images/null.webp') }}" alt="no repsonse"
                                                    width="40" height="40">
                                            @else
                                                {{ $complain->response }}
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ $complain->created_at }}</td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10" class="p-3">No Complains found.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

            </div> @endisset


        </div>

    </div>
@endsection
