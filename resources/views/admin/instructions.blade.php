@extends('layouts.adminApp')
@section('title', 'Instructions : ' . $Global_platFormName)
@section('content')

    <div class="container p-4">
        @include('components.flashMsg')

        <div class="container">

            <h3>Current Instructions : </h3>

            <div class="table-responsive m-5" id="table">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th>ID</th>
                            <th>#</th>
                            <th>Instructor</th>
                            <th>Content</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($instructions)
                            @forelse ($instructions as $instruction)
                                <tr>
                                    <td>{{ $instruction->id }}</td>

                                    <td class="p-2">
                                        <!-- Delete Form -->
                                        <form class="form-inline" method="POST"
                                            action="{{ route('deleteInstructions', $instruction->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger mb-2">Delete</button>
                                        </form>
                                    </td>

                                    <td>{{ $instruction->sender_id }}</td>

                                    <td>
                                        <!-- Edit Form -->
                                        <form class="form-inline" method="POST"
                                            action="{{ route('editInstructions', $instruction->id) }}">
                                            @csrf
                                            <input type="text" class="form-control" name="content"
                                                value="{{ $instruction->content }}">
                                            <button type="submit" class="btn btn-primary mt-2 mb-2">Edit</button>
                                        </form>
                                    </td>

                                    <td>{{ $instruction->created_at }}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="p-3">No Instructions found.</td>
                                    </tr>
                                @endforelse
                            @endisset
                        </tbody>
                    </table>
                </div>

                <hr class="mt-5 mb-5">

                <h3>Add Instruction : </h3>
                <form method="POST" action="{{ route('addInstructions') }}">
                    @csrf <!-- Laravel CSRF protection token -->
                    <div class="form-group mt-3">
                        <label for="grade">Enable for:</label>
                        <select class="form-control" id="grade" name="grade">
                            @include('components.gradeChoose')
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="content" class="form-label">Content : </label>
                        <input type="text" class="form-control" id="content" name="content">
                    </div>
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Are you sure you want to add this instruction ?')">Add</button>
                </form>

            </div>

        @endsection
