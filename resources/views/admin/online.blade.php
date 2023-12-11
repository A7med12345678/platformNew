@extends('layouts.adminApp')
@section('title', 'Online Status : ' . $Global_platFormName)

@section('content')
    <div class="container p-5">
        <h1>Online Students</h1>

      <div class="table-responsive mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Last Activity</th>
                <th>Browser</th>
                <th>Browser Image</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td style="font-weight: bold;" class="h5">{{ $session->center_code }}</td>
                    <td>{{ $session->name }}</td>
                    <td>{{ $session->last_activity_formatted }}</td>
                    <td>{{ $session->browser_name }}</td>
                    <td>
                        <!-- Display the browser image from the CDN using the CDN URL -->
                        <img src="{{ $session->browser_image }}" alt="{{ $session->browser_name }}" width="32" height="32">
                    </td>
                    <td>{{ $session->ip_address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
@endsection
