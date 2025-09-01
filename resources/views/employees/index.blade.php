{{-- @extends('layouts.app')

@section('content') --}}
<div class="container mt-2">
    <h2 class="mb-4">Employee List</h2>

    <table class="table table-bordered table-hover shadow-sm table-sm align-middle ">
        <thead class="table-light">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->firstname }}</td>
                    <td>{{ $employee->lastname }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-warning btn-edit" data-id="{{ $employee->id }}">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $employee->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Edit button
        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: `/employees/${id}/edit`,
                success: function(response) {
                    window.location.href = `/employees/${id}/edit`;
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Could not fetch employee data.', 'error');
                }
            });
        });

        // Delete button
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: `/employees/${id}`,
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', 'Employee has been deleted.', 'success')
                                .then(() => location.reload());
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error', 'Could not delete employee.', 'error');
                        }
                    });
                }
            });

        });
    });
</script>
{{-- @endsection --}}