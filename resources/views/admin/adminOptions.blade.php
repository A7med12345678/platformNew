@extends('layouts.adminApp')
@section('title', 'Admin - Dashboard')
@section('styles')
    <link href="{{ asset('admin-css/chat.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-css/controlPagnation.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-css/dashmin.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4" style="display:flex; align-items:center;">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-globe fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Students</p>
                        <h6 class="mb-0 text-center">
                            @isset($countTotal)
                                {{ $countTotal }}
                            @endisset
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Recently Joined</p>
                        <h6 class="mb-0 text-center">
                            @isset($countRecent)
                                {{ $countRecent }}
                            @endisset
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 pb-2 pt-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <!--<p class="mb-2">Income Expexted (Month)</p>-->
                        <div class=" text-left">
                            <p class="mb-2">1 Sec paied : @isset($count)
                                    <span class="h6"> {{ $count }} </span>
                                @endisset
                            </p>
                            <p class="mb-2">2 Sec paied : @isset($count)
                                    <span class="h6"> {{ $count2 }} </span>
                                @endisset
                            </p>
                            <p class="mb-2">3 Sec paied : @isset($count)
                                    <span class="h6"> {{ $count3 }} </span>
                                @endisset
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 pb-2 pt-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">1 Sec : @isset($data['currentWeek1'])
                                <span class="h6" style="font-size: 0.75rem;">week{{ $data['currentWeek1']->selected_week }},
                                    ({{ substr($data['currentWeek1']->selected_section, -1) }})</span>
                            @endisset
                        </p>
                        <p class="mb-2">2 Sec : @isset($data['currentWeek2'])
                                <span class="h6"
                                    style="font-size: 0.75rem;">week{{ $data['currentWeek2']->selected_week }},
                                    ({{ substr($data['currentWeek2']->selected_section, -1) }})</span>
                            @endisset
                        </p>
                        <p class="mb-2">3 Sec : @isset($data['currentWeek3'])
                                <span class="h6"
                                    style="font-size: 0.75rem;">week{{ $data['currentWeek3']->selected_week }},
                                    ({{ substr($data['currentWeek3']->selected_section, -1) }})</span>
                            @endisset
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->


    @include('components.flashMsg')


    <div class="m-4 text-center">
        <hr>
        <nav>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-primary">As Student</a>
            <a href="{{ route('opt') }}" class="btn btn-warning">Refresh</a>
            <a href="{{ route('welcome') }}" target="_blank" class="btn btn-secondary text-white">HomePage</a>
            <hr>
        </nav>
    </div>

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Current Students</h6>
                <a href="{{ route('Admin/showAll') }}" target="_blank">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>email</th>
                            <th>Mobile</th>
                            <th>Parent Mobile</th>
                            <th>WhatsApp Mobile</th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($current)
                            @foreach ($current as $item)
                                <tr>
                                    <td>
                                        <div class=""
                                            style="display: flex; justify-content:space-around; flex-direction:column;">

                                            <div class="">
                                                <form method="POST"
                                                    action="{{ route('admin/destroyStudent', $item->center_code) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm pl-2 pr-2"
                                                        title="Delete Student"> Delete </button>
                                                </form>
                                                {{-- onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> --}}
                                                </form>
                                            </div>
                                            <div class="mt-3">
                                                <a href="{{ route('admin/editStudentPage', $item->center_code) }}"
                                                    title="Edit Student">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit
                                                    </button>
                                                </a>
                                            </div>

                                        </div>
                                    </td>
                                    <td>{{ $item->center_code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->learn_type }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->parent_phone }}</td>
                                    <td>{{ $item->whatsapp }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="pagination-container text-center pt-4">
                        {!! $current->links() !!}
                    </div>
                @endisset


            </div>


            @if (session('student_Updated'))
                <div class="alert alert-success mt-3" id="flash-msg">
                    {{ session('student_Updated') }}
                </div>
            @endif

            <script>
                setTimeout(function() {
                    document.getElementById('flash-msg').style.display = 'none';
                }, 3000); // hide the message after 3 seconds            
            </script>
        </div>

    </div>
    <!-- Recent Sales End -->


    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Messages</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="">
                        <form id="admin-form" method="POST" action="{{ route('Chat.store') }}">
                            @csrf
                            {{--
                                    <input type="text" class="form-control" name="sender_id"
                                        value="{{ Auth::user()->id }}" hidden>

                        <input type="text" class="form-control" name="sender_name" value="{{ Auth::user()->name }}" hidden> --}}

                            <div class="form-group">
                                <input type="text" class="form-control" name="msg_content">
                            </div>
                            <input type="submit" class="btn btn-primary mt-2">
                        </form>
                    </div>
                    <hr>
                    <div class="chat">
                        @isset($chat)
                            @foreach ($chat as $item)
                                <div
                                    class="message {{ $item->sender_id === Auth::user()->id ? 'message-right' : 'message-left' }}">
                                    <div class="message-sender">{{ $item->sender_name }}</div>
                                    <div class="message-meta">{{ $item->created_at }}</div>
                                    <div class="message-content font-weight-bold">{{ $item->content }}</div>
                                </div>
                            @endforeach
                        @endisset
                    </div>

                    <div class="text-center">
                        {{-- {!! $chat->links() !!} --}}
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">To Do List</h6>
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <form id="admin-form" method="POST" action="{{ route('toDo.store') }}">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" name="content" placeholder="Enter task"
                                    required>
                                {{-- <input class="form-control" type="text" name="sender_id" value="{{ Auth::user()->id }}" hidden> --}}
                                <button type="submit" class="btn btn-primary ms-2">Add</button>
                            </div>
                        </form>
                    </div>

                    @isset($toDo)
                        @foreach ($toDo as $item)
                            <div class="d-flex align-items-center pt-2">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between border p-3"
                                        style="border-radius: 25px;">
                                        <span>{{ $item->content }}</span>

                                        <form method="POST" action="{{ route('toDo.destroy', $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                            {{-- onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> --}}

                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center mt-5">
                            {!! $toDo->links() !!}
                        </div>
                    @endisset

                </div>
            </div>
        </div>
    </div>
    <!-- Widgets End -->


    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="{{ route('welcome') }}" target="_blank">{{ $Global_platFormName }}</a>,
                    All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    Designed By <a href="{{ $Global_programmerWhatsApp }}"
                        target="_blank">{{ $Global_programmerName }}</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

@endsection
