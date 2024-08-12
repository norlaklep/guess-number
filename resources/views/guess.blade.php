<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess the Number</title>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
        const socket = io('http://localhost:3000');

        socket.on('connect', () => {
            console.log('Connected to the server');
        });
    </script>

</head>
<body>
    <h1>Guess the Number</h1>
    <input type="number" id="guess" placeholder="Enter your guess">
    <button onclick="makeGuess()">Submit</button>
    <p id="result"></p>

    <script>
        function makeGuess() {
            const guess = document.getElementById('guess').value;

            fetch('/guess', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({guess: guess})
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result').innerText = data.response;
            });
        }
    </script>
</body>
</html>
