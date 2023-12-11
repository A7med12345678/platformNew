<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .animated-check {
            height: 40px; /* Adjust the height to 40px */
            width: 40px;  /* Adjust the width to 40px */
        }

        .animated-check path {
            fill: none;
            stroke: #7ac142;
            stroke-width: 4;
            stroke-dasharray: 23;
            stroke-dashoffset: 23;
            animation: draw 1s linear forwards;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        @keyframes draw {
            to {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <svg class="animated-check" viewBox="0 0 24 24">
            <path d="M4.1 12.7L9 17.6 20.3 6.3" fill="none" />
        </svg>
    </div>
</body>

</html>
