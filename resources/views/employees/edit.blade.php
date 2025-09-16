@extends('layouts.app')
@section('style')
    <style>
        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 24px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: #0e9273;
        }
    </style>
@endsection

@section('content')
    <form id="frm-edit" method="POST" action="/employees/{{ $employee->id }}">
        <x-forms.input label="First Name:" id="firstname" name="firstname" :value="$employee->firstname" required />

        <x-forms.input label="Last Name:" id="lastname" name="lastname" :value="$employee->lastname" required />

        <x-forms.button type="submit" id="submit" class="btn-primary">
            Update Employee
        </x-forms.button>
        <h1 id="result"></h1>
    </form>
    <table class="table table-bordered table-hover shadow-sm table-sm align-middle ">
        <tr>
            <td><strong>First Name</strong></td>
            <td>{{ $employee->firstname }}</td>
        </tr>
        <tr>
            <td><strong>Last Name</strong></td>
            <td>{{ $employee->lastname }}</td>
        </tr>
    </table>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $("#frm-edit").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Success', response.success, 'success');
                        } else {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        }
                    },
                    error: function (xhr, status, error) {
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

@endsection