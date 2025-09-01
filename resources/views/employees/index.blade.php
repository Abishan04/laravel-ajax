@extends('layouts.app')
@section('content')

<table border="1" style="margin: 20px auto; border-collapse: collapse; width: 100%;">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Actions</th>
    </tr>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->firstname }}</td>
            <td>{{ $employee->lastname }}</td>
            <td>
                <button type="button" class="btn-edit" data-id="{{ $employee->id }}">Edit</button>
                <button type="button" class="btn-delete" data-id="{{ $employee->id }}">Delete</button>
            </td>
        </tr>
    @endforeach
</table>

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
                            Swal.fire(
                                'Deleted!',
                                'Employee has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
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
@endsection