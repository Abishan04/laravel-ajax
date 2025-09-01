@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="frm-create" class="card p-4 shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" required>
                </div>

                <button type="submit" id="submit" class="btn btn-primary w-100">Create Employee</button>
            </form>

            <div class="mt-3">
                <div id="result" class="alert d-none"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $("#frm-create").submit(function(e) {
            e.preventDefault();
            let fname = $("#firstname").val();
            let lname = $("#lastname").val();

            $.ajax({
                type: "POST",
                url: "{{ route('employees.store') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    firstname: fname,
                    lastname: lname
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', response.success, 'success');
                        $("#frm-create")[0].reset();
                    } else {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    }
                },
                error: function(xhr) {
                    let msg = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        msg = xhr.responseJSON.error;
                    }
                    Swal.fire('Error', msg, 'error');
                }
            });
        });
    });
</script>
  @include('employees.index')
@endsection