@extends('layouts.adminApp')
@section('title', 'Welcome Msg : ' . $Global_platFormName)
@section('content')


<div class="container p-4">


    <h3>Clear Table : </h3>
    @include('components.flashMsg')

    <form method="POST" action="{{ route('actionTables') }}" onsubmit="return confirm('Are you sure you want to upload lec or exam?');">
        @csrf

        <div class="form-group">
            {{-- <label>Select Report Type:</label> --}}
            <div class="form-check">
                <input type="radio" id="clear" name="type" value="clear" class="form-check-input" required>
                <label for="clear" class="form-check-label">Clear</label>
            </div>
            <div class="form-check">
                <input type="radio" id="delete" name="type" value="delete" class="form-check-input" required>
                <label for="delete" class="form-check-label">Delete</label>
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="section-selector">Section Selector:</label>
            <select class="form-control" name="table_name">

                @foreach($filteredTableNames as $Table)
                <option value="{{ $Table }}">{{ $Table }}</option>
                @endforeach
                {{-- <option value="instructions">Instructions</option>
                <option value="free_contents">Free Content</option>
                <option value="todo">To do (All Admins)</option>
                <option value="notifications">Notifications</option>
                <option value="complains">Complains</option>
                <option value="adminschat">Admin Chat</option> --}}
            </select>
        </div>

        <button type="submit" class="btn btn-primary">remove</button>
    </form>


    <hr class="mt-5 mb-5">

    <form method="POST" action="{{ route('archiveSpecialLogs') }}" onsubmit="return confirm('Are you sure you want to Archieve DB ?');">
        @csrf
        <button type="submit" class="btn btn-danger">Arcieve </button>
    </form>

</div>

@endsection
