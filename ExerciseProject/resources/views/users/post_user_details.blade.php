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
        <h2>View Notifications</h2>
        <a class="btn btn-primary btn-sm" onClick="add()" href="" style="margin-left: 40%">Create a new Post</a>
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>PhoneNumber</th>
                    <th>Is Read ???</th>
                </tr>
            </thead>
            <tbody>
                @forelse($post_notification_data as $item)

                        @php
                            // Find the user data from the 'users' table based on user_id
                            $user = \DB::table('users')->where('id', $item->user_id)->first();
                        @endphp
                    <tr>
                        <td><strong>{{ $user->id }}</strong></td>
                        <td>{{ ucfirst($user->name) }}</td>
                        <td>{{ ($user->email) }}</td>
                        <td>{{ ucfirst($user->phone_number) }}</td>
                        <td>

                            @php
                                // Fetch the read column value for the user from the post_notification_user table
                                $readValue = DB::table('post_notification_user')
                                ->where('post_notification_id', $id)
                                ->where('user_id', $user->id)
                                ->value('read');

                                // Convert the read column value to 'Yes' or 'No'
                                $isRead = ($readValue === 1) ? 'Yes' : 'No';

                                // Set the color based on the read value
                                $color = ($readValue === 1) ? 'green' : 'red';

                            @endphp

                            <b><span style="color: {{ $color }}" >{{ $isRead }}</span></b>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No notifications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Add the Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
