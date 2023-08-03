
<!DOCTYPE html>
<html>
<head>
    <title>Posted Notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add the Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Posted Notifications</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Message</th>
                    <th>Expiration Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($postNotifications as $notification)
                    <tr>
                        <td><strong>{{ $notification->id }}</strong></td>
                        <td>{{ ucfirst($notification->type) }}</td>
                        <td>{{ ucfirst($notification->message) }}</td>
                        <td>{{ ucfirst($notification->expiration_date) }}</td>
                        <td>
                            @php

                                $readvalue = DB::table('post_notification_user')
                                ->where('post_notification_id', $notification->id)
                                ->where('user_id', $user->id)
                                ->value('read');
                            @endphp

                            @if ($readvalue == 0)

                                <form action="{{ route('mark-notification-read', ['notification' => $notification->id]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="userId" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary">Mark as Read</button>
                                </form>

                            @else
                                <button type="submit" class="btn btn-primary" style="background-color: green">Seen</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No notifications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    <a class="btn btn-primary btn-sm" onClick="add()" href="{{ route('users.index') }}" style="margin-left: 70%"><<--Back</a>
    </div>

    <!-- Add the Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>











































































{{-- <!DOCTYPE html>
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
    <h4 class="mb-3 mt-3">Messages for User Name is  ::  {{ $user->name }}</h4>
    <div class="row">
        @forelse ($postNotifications as $index => $message)
        <div class="col-md-4 mb-4"><br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Message {{ $index + 1 }}: {{ $message->message }}</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    @empty
    <div class="col-md-4 mb-4"><br>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">SORRY!!! NO ANY MESSAGE IN THIS CHAT</h5>
                <p class="card-text"></p>
            </div>
        </div>
    </div>
    @endforelse
    </div>
    <a href="{{route('users.index')}}" class="btn btn-primary">GO bAck</a>
</div>
</body>
</html> --}}
