@extends('layouts.students.studentApp')
@section('title', 'Live - Student')

@section('content')
<div class="container mt-5 p-5">
    <style>
        .unclickable {
            pointer-events: none;
        }

    </style>

    <div class="container mx-auto p-5 unclickable">
        <div class="embed-responsive embed-responsive-16by9 w-100">
            <div id="player"></div>
        </div>
    </div>

    <div class="text-center">
        <button id="play-button" class="btn btn-success text-white">Play</button>
        <button id="pause-button" class="btn btn-danger text-white">Pause</button>
        <button id="full-screen-button" class="btn btn-primary text-white">Full Screen</button>
    </div>

    {{-- {{ $videoId }} --}}
</div>

<script src="https://www.youtube.com/iframe_api"></script>

<script>
    var player;

    // This function creates the YouTube player
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '400'
            , width: '100%'
            , videoId: "{{ $videoId }}"
            , playerVars: {
                controls: 0, // Disable YouTube player controls
            }
            , events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        // Bind the play and pause button actions
        document.getElementById('play-button').addEventListener('click', function() {
            player.playVideo();
        });

        document.getElementById('pause-button').addEventListener('click', function() {
            player.pauseVideo();
        });

        // Add full-screen functionality
        document.getElementById('full-screen-button').addEventListener('click', function() {
            var iframe = document.getElementById('player');
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.mozRequestFullScreen) { // Firefox
                iframe.mozRequestFullScreen();
            } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari and Opera
                iframe.webkitRequestFullscreen();
            } else if (iframe.msRequestFullscreen) { // IE/Edge
                iframe.msRequestFullscreen();
            }
        });
    }

</script>
@endsection
