@extends('layouts.app')
@section('content')
<table>
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
        $('.btn-edit').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `/employees/${id}/edit`,
                success: function(response) {
                    console.log("Edit response:", response);
                },
                error: function(xhr, status, error) {
                    console.log("Edit error:", xhr);
                }
            });
        });

        // Delete button
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: `/employees/${id}`,
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    console.log("Delete response:", response);
                },
                error: function(xhr, status, error) {
                    console.log("Delete error:", xhr);
                }
            });
        });
    });
</script>
@endsection
