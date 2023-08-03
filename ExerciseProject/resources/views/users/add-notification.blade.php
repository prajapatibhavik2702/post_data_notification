<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Add this in the <head> section of your HTML file -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <h1>Craete a new message In One Condition Which user Notification On this user send message  </h1>

        <form method="POST" action="{{ route('users.addNotification') }}">

            @csrf
            <div class="form-group">
                <label for="message">Notification Message</label>
                <input type="text" class="form-control" id="message" name="message" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Notification</button>
        </form>
    </div>

</body>
</html>
