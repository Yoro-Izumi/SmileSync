<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Scheduler</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<button id="recommend-time-btn">Recommend Time</button>
<p id="recommended-time"></p>

<script>
$(document).ready(function() {
    $('#recommend-time-btn').click(function() {
        $.ajax({
            url: 'scheduler.php',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#recommended-time').text('Recommended Time: ' + response.recommended_time);
                } else {
                    $('#recommended-time').text('Failed to get recommendation.');
                }
            },
            error: function() {
                $('#recommended-time').text('Error processing request.');
            }
        });
    });
});
</script>

</body>
</html>
