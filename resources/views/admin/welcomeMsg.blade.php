@extends('layouts.adminApp')
@section('title', 'Welcome Msg : ' . $Global_platFormName)
@section('styles')
    <style>
        #previewContainer img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('content')

    <div class="container p-4">

        @include('components.flashMsg')

        <h1>Free Content : </h1>
        <h2 class="m-3"> video : </h2>

        <form method="POST" action="{{ route('freeCon') }}">
            @csrf
            <div class="mb-3">
                <label for="new_url" class="form-label">URL</label>
                <input type="text" class="form-control" id="new_url" name="new_url" oninput="updatePreview()" required>
            </div>
            <div class="text-center mt-3 mb-3 p-3 h4 text-danger" id="previewContainer"></div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="addRadio" name="type" value="add" checked>
                    <label class="form-check-label" for="addRadio">Add</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="deleteRadio" name="type" value="delete">
                    <label class="form-check-label" for="deleteRadio">Delete</label>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="grade">Enable for:</label>
                <select class="form-control" id="grade" name="grade">
                    @include('components.gradeChoose')
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-4"
                onclick="return confirm('Are you sure you want to add new video ?')">Add</button>
        </form>

        <hr class="mt-5 mb-5">
        <h3> PDF : </h3>

        <form method="POST" action="{{ route('storePDFFree') }}" enctype="multipart/form-data">
            @csrf
            <!-- Laravel CSRF protection token -->

            <div class="mb-3">
                <label for="pdf" class="form-label">New PDF</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
            </div>

            <div class="form-group mt-3">
                <label for="sort">Enable for:</label>
                <select class="form-control" id="sort" name="sort">
                    @include('components.gradeChoose')
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3"
                onclick="return confirm('Are you sure you want to add new video ?')">Add</button>
        </form>

        <h3 class="mt-5">PDF Files</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Delete</th>
                    <th>View</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pdfFiles as $index => $pdfFile)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        @php
                            preg_match('/\/(\d+)\//', $pdfFile, $matches);
                            $numericPart = isset($matches[1]) ? $matches[1] : '';
                            $extractedPath = Str::after($pdfFile, 'public');
                        @endphp
                        <td>{{ basename($pdfFile) }}</td>
                        <td>
                            <a class="btn btn-danger class-guest" href="{{ route('deletePDFFree', basename($pdfFile)) }}">Delete</a>
                        </td>
                        <td>
                            <a href="{{ asset('storage' . $extractedPath) }}" target="_blank"
                                aria-label="View PDF: {{ basename($pdfFile) }}">View PDF</a>
                        </td>
                        <td>{{ $numericPart }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="p-3">No Files found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <hr class="mt-5 mb-5">

        <h3>Dashboard Image : </h3>
        <form method="POST" action="{{ route('dashboardImage') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Select Image : </label> <br>
                <input type="file" class="form-control-file" name="file" id="file">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </form>

        <hr class="mt-5 mb-5">

        <h3>Dashboard Brief : </h3>
        <form method="POST" action="{{ route('dashboardBrief') }}">
            @csrf
            <div class="mb-3">
                <label for="brief">Brief in Dashboard : </label> <br>
                <input type="text" class="form-control" id="brief" name="brief" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <hr class="mt-5 mb-5">

        <h3>Dashboard Other : </h3>
        <form method="POST" action="{{ route('dashboardother') }}">
            @csrf
            <div class="mb-3">
                <label for="other">Other ELement : </label> <br>
                <input type="text" class="form-control" id="other" name="other" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <hr class="mt-5 mb-5">

        <h3>Dashboard Video : </h3>
        <form method="POST" action="{{ route('dashboardYouTubeLink') }}">
            @csrf
            <div class="mb-3">
                <label for="link">Mrketing Link : </label> <br>
                <input type="text" class="form-control" id="link" name="link" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <hr class="mt-5 mb-5">

        <h3>Video Poster : </h3>
        <form method="POST" action="{{ route('storePoster') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="poster">Select Image : </label> <br>
                <input type="file" class="form-control" id="poster" name="poster" required>
            </div>

            <div class="form-group mt-3">
                <label for="gradePoster">Enable for:</label>
                <select class="form-control" id="gradePoster" name="grade">
                    @include('components.gradeChoose')
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </form>

        <hr class="mt-5 mb-5">

        <h3>Site Info : </h3>
        <form method="POST" action="{{ route('siteInfo') }}">
            @csrf

            <div class="form-group mt-3">
                <label for="what">What to update ?</label>
                <select class="form-control" id="what" name="what">
                    <option value="7">PlatForm Name</option>
                    <option value="11">PlatForm Description</option>
                    <option value="10">PlatForm/Instructor Facebook</option>
                    <option value="8">Instructor Name</option>
                    <option value="9">Instructor Phone</option>
                    <option value="13">Instructor Whatsapp</option>
                    <option value="18">Instructor Youtube</option>
                    <option value="12">Current Year</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="content">Update to :</label> <br>
                <input type="text" class="form-control" id="content" name="content" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </form>

        <hr class="mt-5 mb-5">

        <h3>Groups : </h3>
        <form method="post" action="{{ route('editGroups') }}">
            @csrf
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="addGroup" name="type" value="add"
                        checked>
                    <label class="form-check-label" for="addGroup">Add</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="deleteGroup" name="type" value="delete">
                    <label class="form-check-label" for="deleteGroup">Delete</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="when" class="form-label"> Days :</label>
                <select class="form-select" id="when" name="when">
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    @section('js')
        <script src="https://www.youtube.com/iframe_api"></script>
        <script>
            // Variable to store the current YouTube player
            let currentPlayer = null;

            function updatePreview() {
                const inputText = document.getElementById('new_url').value;
                const previewContainer = document.getElementById('previewContainer');

                // Clear previous preview
                clearPreview();

                // Extract video ID from YouTube URL
                const videoId = getYouTubeVideoId(inputText);

                // console.log(videoId);

                if (videoId) {
                    // Create a YouTube player
                    currentPlayer = new YT.Player('previewContainer', {
                        height: '300',
                        width: '100%',
                        videoId: videoId,
                        events: {
                            'onReady': onPlayerReady
                        }
                    });
                } else {
                    // Display a message if it's not a valid YouTube URL
                    previewContainer.textContent = 'Invalid YouTube URL';
                }
            }

            function clearPreview() {
                const previewContainer = document.getElementById('previewContainer');
                // Dispose of the current YouTube player
                if (currentPlayer) {
                    currentPlayer.destroy();
                    currentPlayer = null;
                }
                previewContainer.innerHTML = 'Invalid YouTube URL';

            }

            function getYouTubeVideoId(url) {
                // Regular expression to extract YouTube video ID from URL
                const regExp =
                    /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
                const match = url.match(regExp);

                return match ? match[1] : null;
            }

            function onPlayerReady(event) {
                // You can do additional actions when the player is ready, if needed
            }
        </script>
    @endsection

@endsection
