
<html>
<head>
        <title>Post Notification</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <style type="text/css">
            .dropdown-toggle{
                height: 40px;
                width: 400px !important;
            }
    </style>
</head>
<body>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mx-auto col-md-6 mt-5">
        <h1 class="h3 mb-0 text-gray-800 mb-3">Post Notification</h1>

        <a class="btn btn-primary btn-sm" onClick="add()" href="{{ route('users.index') }}">SHOW User Dashboard</a>
    </div>


        <form id="notificationForm" class="col-md-6 mx-auto" method="post" action="{{ route('posts.store') }}">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert-danger p-2 col-md-10 mb-2">{{$error }}</div>
                    @endforeach
                @endif

                <div class="form-group mb-4">
                    <label for="notificationTitle">Type   : </label>
                    <select class="form-select form-select-md mb-3 mt-2 selectpicker ml-3" aria-label=".form-select-lg example" name="type" required >

                    <option value="marketing">Marketing</option>
                    <option value="invoice">Invoice</option>
                    <option value="system">System</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="notificationMessage">Message   :</label>
                    <input type ="text" class="form-control mt-2" id="notificationMessage" rows="1" name="message" maxlength="60" placeholder="Enter Message for User" required >
                </div>

            <!-- Multiselect DropDown -->
                <div class="form-group">
                    <label>Receive Notification     :</label>
                    <select class="selectpicker ml-3" multiple data-live-search="true" name="users[]" required>

                        @php
                            $allUserIds = [];
                        @endphp

                        @foreach($users as $user)
                            @php
                                $id = $user->id;
                                $allUserIds[] = $id;
                            @endphp
                                <option value="{{$id}}">{{$id}}. {{$user->name}}</option>
                            @endforeach

                        <option value="all-user" data-user-id="{{ json_encode($allUserIds) }}">All Users</option>
                    </select>
                </div>

                <div class="form-group col-md-12 mt-5">

                    <label>Expiration Date : </label>
                    <input type="date" name="expiry_date" required>
                    </div>

                    <div class="form-group col-md-6 mt-5">
                        <button type="submit" class="btn btn-primary mx-auto mb-2" id="submit">Post Notification</button>
                        <a class="btn btn-primary mx-auto mb-2" onClick="add()" style="margin-left: 100%" href="{{ route('posts.show') }}">Back</a>

                </div>
        </form>



<!-- Initialize the plugin: -->
<script type="text/javascript">
        $(document).ready(function() {
            $('select').selectpicker();
        });

        $('.selectpicker').on('changed.bs.select', function() {
        var selectedValues = $(this).val();

        if (selectedValues !== null && selectedValues.includes('all-user')) {
            var userIds = $('option[value="all-user"]').data('user-id');
            var filteredValues = selectedValues.filter(val => val !== 'all-user');

            $(this).selectpicker('val', filteredValues.concat(userIds));
        }
    });
    </script>
</body>
</html>
