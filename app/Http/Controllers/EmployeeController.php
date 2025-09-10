<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('employees.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->save();
        return response()->json(['success' => 'Employee created successfully.']);
    }

    /**
     * Display the specified resource.
     */
public function show($id)
{
    $employee = Employee::findOrFail($id);

    if (request()->ajax()) {
        return view('employees.show', compact('employee'))->render(); // Only HTML
    }

    return view('employees.show', compact('employee')); // Full page
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
    {
        $employee = Employee::find($id);

        if (request()->ajax()) {
            return response()->json([
                'firstname' => $employee->firstname,
                'lastname' => $employee->lastname,
            ]);
        }

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        if ($employee->save()) {
            return response()->json(['success' => 'Employee updated successfully']);
        } else {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
    }
}
