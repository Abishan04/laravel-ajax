@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="frm-create" class="card p-4 shadow-sm" action="{{ route('employees.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 form-floating">
                        <x-forms.input name="firstname" label="First Name" placeholder="First Name" required />
                    </div>

                    <div class="mb-3 form-floating">
                        <x-forms.input name="lastname" label="Last Name" placeholder="Last Name" required />
                    </div>

                    <x-forms.button type="submit" id="submit" class="btn- w-50">
                        Create Employee
                    </x-forms.button>
                </form>

                <div class="mt-3">
                    <div id="result" class="alert d-none"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#frm-create").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Success', response.success, 'success');
                            $("#frm-create")[0].reset();
                        } else {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        }
                    },
                    error: function (xhr) {
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
    @include('partials.result')
@endsection