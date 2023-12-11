{{-- html meta :  --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="author" content="{{ $Global_programmerName }}">
<meta property="og:site_name" content="{{ $Global_platFormName }}" />
<meta property="og:site" content="{{ $Global_platFormSite }}" />
<meta property="og:description" content="{{ $Global_platFormDescription }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ asset('welcome/images/op.png') }}" />
<meta name="keywords" content="platform , physics , {{ $Global_platFormName }}">
<meta name="description"
    content="An innovative platform dedicated to physics enthusiasts, providing a collaborative space for learning and exploring the world of physics.">

{{-- favicon : --}}
<link rel="icon" href="{{ asset('storage/image/newFavicon.ico') }} ">

{{-- css & bootstrap : --}}
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

{{-- icons : --}}

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> --}}
<!--<script src="https://kit.fontawesome.com/2b6685be60.js" crossorigin="anonymous" defer></script>-->

{{-- <link rel="preconnect" href="https://code.jquery.com">
<link rel="preload" as="script" href="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> --}}
{{-- <script src="{{ asset('general-js/jquery-3.6.0.min.js') }}"></script> --}}
{{-- <script>
    function loadScript(src, callback) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = src;
        script.onload = callback;
        document.body.appendChild(script);
    }

    loadScript('{{ asset('general-js/jquery-3.6.0.min.js') }}', function() {
        // Callback function, you can put your code here that depends on jQuery
    });
</script> --}}


<script>
    var script1 = document.createElement('script');
    script1.onload = function() {
        // Code to execute after the jQuery script has loaded
        // console.log("jQuery has been loaded!");
    };
    script1.src = '{{ asset('general-js/jquery-3.6.0.min.js') }}';
    document.head.appendChild(script1);

    // var script2 = document.createElement('script');
    // script2.onload = function () {
    //     // Code to execute after the Font Awesome script has loaded
    //     // console.log("Font Awesome has been loaded!");
    // };
    // script2.src = 'https://kit.fontawesome.com/2b6685be60.js';
    // document.head.appendChild(script2);
</script>

<link rel="preconnect" href="https://kit.fontawesome.com">
<link rel="preload" as="script" href="https://kit.fontawesome.com/2b6685be60.js" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/2b6685be60.js" crossorigin="anonymous"></script>




<link rel="preconnect" href="https://kit.fontawesome.com">
{{-- <link rel="dns-prefetch" href="https://kit.fontawesome.com"> --}}
<link rel="preload" as="script" href="https://kit.fontawesome.com/2b6685be60.js" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/2b6685be60.js" crossorigin="anonymous"></script>


{{-- fonts : --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Marhey&display=swap" rel="stylesheet"> --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Changa&display=swap" rel="stylesheet"> --}}
<style>
    * {
        text-decoration: none !important;
    }

    th,
    td {
        text-align: center;
        vertical-align: middle;
    }

    /* ---------------------------------------------------------------- mahery :  */
    /* arabic */
    @font-face {
        font-family: 'Marhey';
        font-style: normal;
        font-weight: 400;
        src: url('{{ asset('general-css/fonts/mahery/mahery.woff2') }}') format('woff2');
        unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0898-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC;
        font-display: swap;
    }

    /* latin-ext */
    @font-face {
        font-family: 'Marhey';
        font-style: normal;
        font-weight: 400;
        src: url('{{ asset('general-css/fonts/mahery/mahery.woff2') }}') format('woff2');
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    /* latin */
    @font-face {
        font-family: 'Marhey';
        font-style: normal;
        font-weight: 400;
        src: url('{{ asset('general-css/fonts/mahery/mahery2.woff2') }}') format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    /* ---------------------------------------------------------------- changa :  */

    /* arabic */
    @font-face {
        font-family: 'Changa';
        font-style: normal;
        font-weight: 400;
        src: url('{{ asset('general-css/fonts/changa/changa.woff2') }}') format('woff2');
        unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0898-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC;
        font-display: swap;
    }
</style>
