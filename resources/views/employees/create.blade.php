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
                    <label>Select Gender:</label>
                    <div class="form-check">
                        <x-forms.input type="radio" id="male" class="form-check-input" name="gender" value="male"
                            :label="'Male'" />

                        <x-forms.input type="radio" id="female" class="form-check-input" name="gender" value="female"
                            :label="'Female'" />
                    </div>
                    <label>Select Subjects:</label>
                    @foreach($subjects as $subject)
                        <div class="form-check">
                            <x-forms.input type="checkbox" class="form-check-input" id="{{ $subject->id }}" name="subjects[]"
                                value="{{ $subject->id }}" :label="$subject->name" />
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <x-forms.select class="form-select" label="Select Grade" name="grade_id">
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <x-forms.textarea name="address" label="Address" placeholder="Address" required />

                    @foreach($images as $image)
                        <img src="{{ asset($image->filepath) }}" alt="{{ $image->filename }}" />
                    @endforeach
                    <x-forms.button type="submit" id="submit" class="btn- w-100">
                        Create Employee
                    </x-forms.button>
                </form>
      
                <div class="mt-3">
                    <div id="result" class="alert d-none"></div>
                </div>
            </div>
        </div>
    </div>
    {{--
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
    </script> --}}
    @include('partials.result')
@endsection