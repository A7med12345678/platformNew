<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select {
            padding: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <label for="countdownNumber">Select Exam Number:</label>
    <select id="countdownNumber">
        <?php
        for ($i = 1; $i <= 45; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <button id="clearLocalStorageButton">Save</button>

    <script>
        // Get a reference to the clearLocalStorageButton element
        var clearButton = document.getElementById('clearLocalStorageButton');
        var countdownNumberSelect = document.getElementById('countdownNumber');

        // Add a click event listener to the button
        clearButton.addEventListener('click', function() {
            var countdownNumber = countdownNumberSelect.value;

            // Check if the input is valid
            if (countdownNumber >= 1 && countdownNumber <= 45) {
                var keyToClear = "countDownDate" + countdownNumber;

                // Remove the specified key from local storage
                localStorage.removeItem(keyToClear);

                // Provide feedback to the user
                alert('Countdown-related local storage item (' + keyToClear + ') has been cleared.');
            } else {
                alert('Please select a valid countdown number between 1 and 45.');
            }
        });
    </script>
</body>
</html>
