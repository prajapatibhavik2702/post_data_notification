<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add the Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Add the Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add the Bootstrap Toggle Switch CSS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card mb-3 mt-3">
            <div class="card-body">
                <h4>Now,, Login User Name is: {{ $name->name }}</h4>

                    <a href="{{ route('posts.show') }}" class="btn btn-primary" style="margin-left: 75%">Show a Post</a>

                </div>
            </div>

            <h4 class="mb-3 mt-3">User List</h4><br>

            <div class="container">
                <div class="row">
                    @foreach ($users as $user)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title">{{ $user->name }}</h5>

                                        <!-- User Settings Icon -->
                                        <a href="{{ route('user.settings', ['userId' => $user->id]) }}">
                                            <i class="fa fa-gear ml-2" style="font-size: 20px; color: gray;"></i>
                                        </a>
                                        </div>

                                        <div>
                                            <b><p>Email: {{ $user->email }}</p></b>
                                            <b><p>Number: {{ $user->phone_number }}</p></b>
                                        </div>

                                        <!-- Toggle Switch -->
                                        <form action="{{ route('users.updateNotificationStatus') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="userId" value="{{ $user->id }}">
                                            <input type="hidden" name="notificationEnabled" value="{{ $user->notification_on_off ? 0 : 1 }}">
                                            <button type="submit" class="btn btn-primary">
                                                {{ $user->notification_on_off ? 'Off' : 'On' }}
                                            </button>
                                        </form><br>

                                            @php
                                                $unreadNotifications = DB::table('post_notification_user')
                                                    ->where('user_id', $user->id)
                                                    ->where('read', 0)
                                                    ->get()
                                                    ->count();
                                            @endphp

                                            @if ($unreadNotifications > 0)
                                                <!-- Notification icon with badge -->
                                                <a href="{{ route('users.messages.show', $user) }}" class="btn btn">
                                                    <i class="fa fa-bell" style="color: green;"></i>
                                                    <span class="badge badge-danger">{{ $unreadNotifications }}</span>
                                                </a>
                                            @else
                                                <!-- Notification icon -->
                                                <a href="{{ route('users.messages.show', $user) }}" class="btn btn" style="color: green;">
                                                    <i class="fa fa-bell"></i>
                                                </a>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</body>
</html>
