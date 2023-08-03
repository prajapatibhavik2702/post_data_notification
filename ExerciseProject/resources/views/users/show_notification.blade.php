<!DOCTYPE html>
<html>
<head>
    <title>Posted Notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add the Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add the DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Notifications</h2>
            <a class="btn btn-primary btn-sm" onClick="add()" href="{{ route('posts.create') }}">Create a new Post</a><br><br>
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3" id="notificationsTable">
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
                @forelse($notifications as $notification)
                    <tr>
                        <td><strong>{{ $notification->id }}</strong></td>
                        <td>{{ ucfirst($notification->type) }}</td>
                        <td>{{ ucfirst($notification->message) }}</td>
                        <td>{{ ucfirst($notification->expiration_date) }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" onClick="add()" style="margin-left:30%" href="{{ route('user.notification.detail', $notification->id ) }}">View User Deatils </a>
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
    <!-- Add the DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#notificationsTable').DataTable();
        });
    </script>
</body>
</html>
