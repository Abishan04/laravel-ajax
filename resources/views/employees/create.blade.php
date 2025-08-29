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
    <form   id="frm-create">
        @csrf
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>

        <button type="submit" id="submit">Create Employee</button>
        <h1 id="result"></h1>
    </form>
    <script>
        $(document).ready(function() {
            $("#frm-create").submit(function(e) {
                e.preventDefault();
                let fname=$("#firstname").val();
                let lname=$("#lastname").val();
                $.ajax({
                    type:"post",
                    url:"{{route("employees.store")}}",
                    data:{
                        _token: "{{ csrf_token() }}",
                        firstname:fname,
                        lastname:lname
                    },
                    success:function(response){
                        console.log(response);
                        alert(response.success);
                        $("#result").text(response.success);
                        $("#result").fadeToggle(2000);
                    },
                    error:function(xhr,status,error){
                        alert(error);
                        $("#result").text(response.error);
                        $("#result").fadeToggle(2000);
                    }

                });
            });
        });

    </script>
@endsection
