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
                    <button type="button" class="btn btn-sm btn-warning btn-edit"
                        data-id="{{ $employee->id }}">Edit</button>
                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                        data-id="{{ $employee->id }}">Delete</button>
                    <button type="button" class="btn btn-sm btn-info btn-show"
                        data-id="{{ $employee->id }}">Show</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.get(`/employees/${id}/edit`, function(response) {
                Swal.fire({
                    title: 'Edit Employee',
                    html:
                        `<input id="swal-input1" class="swal2-input" placeholder="First Name" value="${response.firstname}">` +
                        `<input id="swal-input2" class="swal2-input" placeholder="Last Name" value="${response.lastname}">`,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    preConfirm: () => {
                        return {
                            firstname: document.getElementById('swal-input1').value,
                            lastname: document.getElementById('swal-input2').value
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX PUT/PATCH request to update
                        $.ajax({
                            url: `/employees/${id}`,
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "PUT",
                                firstname: result.value.firstname,
                                lastname: result.value.lastname
                            },
                            success: function(res) {
                                Swal.fire('Success', 'Employee updated!', 'success')
                                    .then(() => location.reload());
                            },
                            error: function(xhr) {
                                Swal.fire('Error', 'Update failed.', 'error');
                            }
                        });
                    }
                });
            }).fail(function() {
                Swal.fire('Error', 'Could not fetch employee data.', 'error');
            });
        });

        // Delete button
        $(document).on('click', '.btn-delete', function (e) {
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
                        success: function (response) {
                            Swal.fire('Deleted!', 'Employee has been deleted.', 'success')
                                .then(() => location.reload());
                        },
                        error: function (xhr, status, error) {
                            Swal.fire('Error', 'Could not delete employee.', 'error');
                        }
                    });
                }
            });
        });

        // Show button
            // Show button
$(document).on('click', '.btn-show', function (e) {
    e.preventDefault(); // Prevent default behavior
    let id = $(this).data('id');

    // Optional: show loading while fetching
    Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.get(`/employees/${id}`, function (response) {
        Swal.fire({
            method:"get",
            title: 'Employee Details',
            html: response,
            icon: 'info',
            showCloseButton: true,
            showConfirmButton: false,
            width: '600px'
        });
    }).fail(function () {
        Swal.fire('Error', 'Could not load employee details.', 'error');
    });

    return false; // Extra safety to prevent bubbling

        });
    });
</script>
