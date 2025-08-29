@extends('layouts.app')
@section('content')
<form id="frm-index">
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Actions</th>
        </tr>
        @foreach($employees as $employee)
            <tr>
                <td>{{$employee->firstname}}</td>
                <td>{{$employee->lastname}}</td>
                <td>
                    <button type="button" id="btn-edit" >Edit</button>
                    <button type="button" id="btn-delete" >Delete</button>
                </td>
            </tr>
        @endforeach
    </table>
</form>
<script>
    $(document).ready(function() {
        $("#frm-index").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type:"get",
                url:"{{route("employees.index")}}",
                success:function(response){
                    console.log(response);
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                }
            });
        });
        $("#btn-edit").click(function(e) {
            e.preventDefault();
            $.ajax({
                type:"get",
                url: "{{ route('employees.edit', $employee->id) }}",
                success:function(response){
                    console.log(response);
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                }
            });
        });
        $("#btn-delete").click(function(e) {
            e.preventDefault();
            $.ajax({
                type:"get",
                url:"{{route("employees.destroy")}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $employee->id
                }
                success:function(response){
                    console.log(response);
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                }
            });
        })
    })
@endsection
