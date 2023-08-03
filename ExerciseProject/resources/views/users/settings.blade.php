<!DOCTYPE html>
<html>
<head>
    <title>User Settings </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add the Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Add the Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5>User Settings (You can Update)</h5>
            </div>
            <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->has('phone'))
                            <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                        @endif

                        @if(session('phoneSuccess'))
                            <div class="alert alert-success">
                                {{ session('phoneSuccess') }}
                            </div>
                        @endif

                    <form action="{{ route('users.updateNotificationStatus') }}" method="POST">
                        @csrf
                        Notification Changes ::
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <input type="hidden" name="notificationEnabled" value="{{ $user->notification_on_off ? 0 : 1 }}">
                        <button type="submit" class="btn btn-primary">
                            {{ $user->notification_on_off ? 'Off' : 'On' }}
                        </button>
                    </form>

                    <form action="{{ route('user.settings.update',$user->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ $user->phone_number }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Settings</button>
                        <button class="btn btn-primary" style="background-color:aliceblue"><a href="{{ route('users.index') }}">Back-></a></button>
                    </form>
                </div>
            </div>
        </div>

    <!-- Add the Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
