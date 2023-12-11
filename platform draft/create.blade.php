@extends('back.layouts.back')

@section('title', __('Create New Lessons'))

@section('header_name')
    <h1 class="m-0"> {{ __('Create Lesson') }} </h1>
@endsection
@section('header_routes')
    <li class="breadcrumb-item"><a href="{{ route('back.lessons.index') }}">{{ __('Lesson') }}</a></li>
    <li class="breadcrumb-item active"> {{ __('Create New Lessons') }} </li>
@endsection

@section('style')
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
@endsection

@section('content')
    <div class="container card p-2">
        <form action="{{ route('back.lessons.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            id="title" required name="title" placeholder="{{ __('Title') }}"
                            value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <div class="text-danger p-1 mt-1">
                                <i class="fas fa-tiems mx-1"></i>
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">{{ __('Order') }}</label>
                        <input type="number" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}"
                            id="order" required name="order" placeholder="{{ __('Order') }}"
                            value="{{ old('order') }}">
                        @if ($errors->has('order'))
                            <div class="text-danger p-1 mt-1">
                                <i class="fas fa-tiems mx-1"></i>
                                {{ $errors->first('order') }}
                            </div>
                        @endif
                    </div>
                </div> --}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control textarea-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description"
                            required name="description" placeholder="{{ __('Description') }}"> {{ old('description') }} </textarea>
                        @if ($errors->has('description'))
                            <div class="text-danger p-1 mt-1">
                                <i class="fas fa-tiems mx-1"></i>
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">{{ __('site.Category') }}</label>
                        <select required name="category_id" class="form-control">
                            @foreach (CourseCategories::get() as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <div class="text-danger p-1 mt-1">
                                <i class="fas fa-tiems mx-1"></i>
                                {{ $errors->first('category_id') }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <img  loading="lazy" id="display_image" class="m-auto d-flex mb-2"
                        width="100" height="100" />
                    <div class="form-group">
                        <label for="video">{{ __('site.Image') }}</label>
                        <br>
                        <input type="file" name="video" accept="video/*"
                            onchange="document.getElementById('display_image').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div> --}}

                <div class="col-md-6">
                    <label for="video">
                        {{ __('site.Upload Video') }}
                    </label>
                    <div class="row m-0">
                        <input type="file" class="form-control col-10" id="video"
                            data-url-upload="{{ route('video_upload') }}" accept="video/*">
                        <input type="text" hidden id="video_path" value="{{ old('video_path') }}" name="video_path"
                            accept="video/*">
                        <button type="button" class="btn btn-secondary col-2" id="uploadVideo">
                            <i class="fas fa-upload"></i>
                        </button>
                    </div>
                    {{-- <input type="button" value="Upload" onclick="uploadVideo(e)"> --}}
                    @if ($errors->has('video_path'))
                        <div class="text-danger p-1 mt-1">
                            <i class="fas fa-tiems mx-1"></i>
                            {{ $errors->first('video_path') }}
                        </div>
                    @endif
                    <div id="uploadStatus">
                        <span id="progress">

                        </span>
                    </div>
                    <div id="upload_success" class="alert alert-success mt-2 d-none">
                        <div id="upload_success" {{-- class="alert alert-success mt-removeClasS('d-none') --}} </div>
                            <div id="upload_error" class="alert alert-danger mt-2 d-none">
                            </div>
                        </div>
                        @php
                            set_time_limit(360);
                            ini_set('max_execution_time', 360);
                            ini_set('memory_limit', '2048M');
                        @endphp
                    </div>
                    <button class="col-md-6 float-right btn btn-primary">
                        {{ __('site.Save') }} </button>
        </form>
    </div>
@endsection


@section('script')
    {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
    <script src="{{ asset('assets/front/js/axios.min.js') }}"></script>

    <script>
        // document.getElementById('uploadVideo').addEventListener('click', uploadVideo);

        document.getElementById('uploadVideo').addEventListener('click', function() {
            const CHUNK_SIZE = 5 * 1024 * 1024; // 1MB
            const fileInput = document.getElementById('video');
            const file = fileInput.files[0];
            let start = 0;
            let end = CHUNK_SIZE;
            let chunkIndex = 0;

            const video_title = $('input[name=title]')

            const path = fileInput.getAttribute('data-url-upload');

            if (video_title.val().length === 0) {
                video_title.addClass('is-invalid')
            } else {
                video_title.removeClass('is-invalid')

                function uploadChunk() {
                    if (start < file.size) {
                        const blob = file.slice(start, end);
                        const formData = new FormData();
                        formData.append('video_title', video_title.val());
                        formData.append('video', blob);
                        formData.append('chunkIndex', chunkIndex);
                        formData.append('totalChunks', Math.ceil(file.size / CHUNK_SIZE));

                        axios.post(path, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                            onUploadProgress: function(progressEvent) {
                                let percentCompleted = Math.round((progressEvent.loaded * 100) /
                                    progressEvent.total);
                                document.getElementById('uploadStatus').style.display = 'flex';
                                document.getElementById('progress').style.width = percentCompleted +
                                    '%';
                            }
                        }).then(function(response) {
                            if (response.data.status === 'success') {
                                start += CHUNK_SIZE;
                                end = start + CHUNK_SIZE;
                                chunkIndex++;
                                uploadChunk();
                                document.getElementById('video_path').value = response.data.path;
                                $('#upload_success').val(response.data.status)
                                $('#upload_success').removeClass('d-none')
                                console.log(response)
                            } else {
                                console.log('Upload failed:', response);
                            }
                        }).catch(function(error) {
                            console.log('Upload error:', error);
                        });
                    } else {
                        console.log('Upload complete');
                    }
                }
                uploadChunk();
            }
        });

        // function uploadVideo(e) {
        //     // const inputElement = document.getElementById('video');

        //     let fileInput = document.getElementById('video');
        //     const path = fileInput.getAttribute('data-url-upload');
        //     let file = fileInput.files[0];
        //     let formData = new FormData();
        //     formData.append('video', file);
        //     // document.getElementById('uploadStatus').style.display = 'none';
        //upload_success     // document.getElementById('uploadStatus').style.display = 'none';
        // document.getElementById('uploadStatus').style.display removeClasS('d-none')
        //     document.getElementById('upload_error').classList.add('d-non

        //     axios.post(path, formData, {
        //             headers: {
        //                 "Accept": "application/json",
        //                 'Content-Type': 'multipart/form-data'
        //             },
        //             onUploadProgress: function(progressEvent) {
        //                 let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
        //                 document.getElementById('uploadStatus').style.display = 'flex';
        //                 document.getElementById('progress').style.width = percentCompleted + '%';
        //                 console.log(percentCompleted)
        //             }
        //         })
        //         .then(function(response) {
        //             document.getElementById('video_path').value = response.data.path;
        //upload_success             document.getElementById('video_path').value = response.data.;
        // upload_success document.getElementById('video_path').value removeClasS('d-none')
        //             document.getElementById('uploadStatus').style.display = 'non
        //upload_success             document.getElementById('uploadStatus').style.display = 'none';
        // upload_success document.getElementById('uploadStatus').style.display removeClasS('d-none')
        //
        //         .catch(function(error) {
        //             document.getElementById('upload_error').innerHTML = error?.response?.data?.message;
        //             document.getElementById('uploadStatus').style.display = 'none';
        //             document.getElementById('upload_error').classList.remove('d-none');
        //         });
        // }
    </script>
@endsection