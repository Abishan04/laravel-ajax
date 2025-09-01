@extends('layouts.app')
@section('style')
    <style>
        h1 {
            text-align: center;
            margin-top: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        strong {
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <h1>Employee Details</h1>
    <table border="1" style="margin: 20px auto;width: 80%;">
        <tr>
            <td><strong>First Name</strong></td>
            <td>{{ $employee->firstname }}</td>
        </tr>
        <tr>
            <td><strong>Last Name</strong></td>
            <td>{{ $employee->lastname }}</td>
        </tr>
    </table>
@endsection