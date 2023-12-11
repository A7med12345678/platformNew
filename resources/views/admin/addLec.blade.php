@extends('layouts.adminApp')
@section('title', 'Enable Lec : ' . $Global_platFormName)
@section('content')
    <style>
        #uploadStatus {
            width: 100%;
            height: 20px;
            background: #f1f1f1;
            margin: 9px 0;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            display: none;
        }

        #uploadStatus #progress {
            width: 0%;
            height: 100%;
            background: #3eba54;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>

    <!-- Content Start -->
    <div class="container">

        <div class="container pt-5">

            <h1>Add Lecture & Exam</h1>

            @include('components.flashMsg')

            {{-- @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
    </div>
    @endif --}}

            <div class="h3 mt-5 mb-3 text-primary">Enable Lectures & Exams</div>


            <div class="container mt-5">
                <form id="admin-form" method="POST" action="{{ route('weeks.store') }}"
                    onsubmit="return confirm('Are you sure you want to upload lec or exam?');">
                    @csrf

                    <div class="form-group">
                        <label for="week-selector">Week Selector:</label>
                        <select class="form-control" id="week-selector" name="selected_week">
                            @for ($week = 1; $week <= $Global_unitNum; $week++)
                                <option value="{{ $week }}">{{ $Global_unitName }} {{ $week }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="section-selector">Section Selector:</label>
                        <select class="form-control" id="section-selector" name="selected_section">
                            <option value="sec1">Lecture 1</option>
                            <option value="sec2">Lecture 2</option>
                            <option value="sec3">Home Work</option>
                            <option value="sec4">Quiz</option>
                            <option value="sec5">Go Live</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="section-selector">Enable for:</label>
                        <select class="form-control" id="grade-selector" name="selected_grade">
                            @include('components.gradeChoose')
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="lecTitle">
                    </div>

                    <div class="form-group mt-3">
                        <label for="live" class="form-label">Live Link :</label>
                        <input type="text" class="form-control" id="live" name="live">
                    </div>

                    <button type="submit" class="btn btn-primary m-3 mb-0">Save</button>
                </form>
            </div>

            <br>
            <hr>

            <div class="h3 mt-5 mb-3 text-primary">Upload Lecture</div>

            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="section-selector mt-5">Lec For:</label>
                    <select class="form-control" id="grade" name="grade">
                        @include('components.gradeChoose')
                        <option value="free">Free Content.</option>
                    </select>
                </div>


                <div class="form-group mt-4">
                    <label for="section-selector">Week Selector:</label>
                    <select class="form-control" id="week" name="week">
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="week{{ $week }}">{{ $Global_unitName }} {{ $week }}</option>
                        @endfor
                    </select>
                    </select>
                </div>

                <div class="form-group mt-4 mb-4">
                    <label for="section-selector">Section Selector:</label>
                    <select class="form-control" id="sec" name="sec">
                        @for ($week = 1; $week <= 2; $week++)
                            <option value="sec{{ $week }}">Lecture {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                <div class="row m-0">
                    <input type="file" class="form-control col-10" id="video"
                        data-url-upload="{{ route('video_upload') }}" accept="video/*">
                    <input type="text" hidden id="video_path" name="video_path" accept="video/*">
                    <button type="button" class="btn btn-secondary col-2 m-3" id="uploadVideo">
                        upload
                    </button>
                </div>


                <div id="uploadStatus">
                    <span id="progress">
                    </span>
                </div>
                <div id="uploadCompleteMessage" style="display: none; text-align:center;">Upload complete</div>

                @php
                    set_time_limit(360);
                    ini_set('max_execution_time', 360);
                    ini_set('memory_limit', '2048M');
                @endphp

            </form>

            <hr>

            <div class="h3 mt-5 mb-3 text-primary">Upload PDF :</div>

            <form action="{{ route('storePDF') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="grade">PDF For:</label>
                    <select class="form-control" id="grade" name="grade">
                        @include('components.gradeChoose')
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="week">Week Selector:</label>
                    <select class="form-control" id="week" name="week">
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="{{ $week }}">{{ $Global_unitName }} {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="pdf">Select PDF File:</label> <br>
                    <input type="file" name="pdf" class="form-control-file p-2">
                </div>

                <button type="submit" class="btn btn-primary m-3">Submit</button>
            </form>

            <hr>

            <div class="h3 mt-5 mb-3 text-primary">Delete PDF :</div>

            <form action="{{ route('deletePDF') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="grade">PDF For:</label>
                    <select class="form-control" id="grade" name="grade">
                        @include('components.gradeChoose')
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="week">Week Selector:</label>
                    <select class="form-control" id="week" name="week">
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="{{ $week }}">{{ $Global_unitName }} {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="btn btn-primary m-3">Submit</button>
            </form>


            <div class="mx-auto text-center m-5">
                <button class="btn btn-danger" id="force" onclick="forceUpload()">Force Upload</button>
            </div>



        </div>

    </div>

@section('js')

    <link href="{{ asset('admin-js/upload/axios.js') }}" rel="stylesheet">
    <link href="{{ asset('admin-js/upload/jq.js') }}" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        document.getElementById('uploadVideo').addEventListener('click', function() {
            // Clear the previous "Upload complete" message
            document.getElementById('uploadCompleteMessage').style.display = 'none';

            const CHUNK_SIZE = 5 * 1024 * 1024; // 5MB
            const fileInput = document.getElementById('video');
            const file = fileInput.files[0];
            const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
            let uploadedChunks = 0; // Number of successfully uploaded chunks

            const path = fileInput.getAttribute('data-url-upload');

            // Get the selected values from Week Selector and Section Selector
            const week = $('#week').val();
            const sec = $('#sec').val();

            // Combine Week and Section values to create the title
            const video_title = `Week ${week}, Section ${sec}`;

            if (week.length === 0 || sec.length === 0) {
                // Handle the case where week or sec is empty here
                console.log('Week or Section is empty');
                return;
            } else {
                // Continue with the upload
                function uploadChunk() {
                    const start = uploadedChunks * CHUNK_SIZE;
                    const end = Math.min(start + CHUNK_SIZE, file.size);
                    const blob = file.slice(start, end);
                    const formData = new FormData();
                    formData.append('video_title', video_title); // Use the combined title
                    formData.append('video', blob);
                    formData.append('chunkIndex', uploadedChunks);
                    formData.append('totalChunks', totalChunks);
                    formData.append('grade', $('#grade').val());
                    formData.append('week', week);
                    formData.append('sec', sec);

                    axios.post(path, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent) {
                            const percentCompleted = Math.round((uploadedChunks / totalChunks) * 100);
                            document.getElementById('uploadStatus').style.display = 'flex';
                            document.getElementById('progress').style.width = percentCompleted + '%';
                            if (percentCompleted === 100) {
                                document.getElementById('uploadCompleteMessage').style.display =
                                    'block';
                            }
                            console.log(percentCompleted);
                        }

                    }).then(function(response) {
                        if (response.data.status === 'success') {
                            if (uploadedChunks < totalChunks) {
                                uploadChunk();
                            } else {
                                document.getElementById('video_path').value = response.data.path;
                                $('#upload_success').val(response.data.status)
                                $('#upload_success').removeClass('d-none')
                                console.log('Upload complete');
                            }
                        } else {
                            console.log('Upload failed:', response);
                        }
                        uploadedChunks++;

                    }).catch(function(error) {
                        console.log('Upload error:', error);
                    });
                }
                uploadChunk();
            }
        });
    </script>


@endsection

@endsection
