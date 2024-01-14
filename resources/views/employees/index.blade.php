<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel Datatables Yajra Server Side</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link href="{{ asset('css/employee.css') }}" rel="stylesheet">
</head>

<body>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of employees</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered employees-table" id="employees-table"
                    data-url="{{ route('employees.index') }}">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employ)
                            <tr>
                                <td>{{ $employ->first_name }}</td>
                                <td>{{ $employ->last_name }}</td>
                                <td>{{ $employ->phone }}</td>
                                <td>{{ $employ->email }}</td>
                                <td class="list-group-item d-flex justify-content-between align-items-center">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('employees.modal');
        @include('employees.confirm_modal');
        @include('positions.create');
        @include('positions.edit_position');
        @include('positions.delete_position');
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</html>
