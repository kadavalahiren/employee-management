<?php

namespace App\Http\Controllers;

use App\Helper\MediaHelper;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeManegementController extends Controller
{
    private $res;

    public function __construct()
    {
        $this->res = new BaseController();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Employee::select('*')->orderby('id', 'DESC')->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('first_name', function ($row) {
                        return $row->first_name;
                    })
                    ->editColumn('last_name', function ($row) {
                        return $row->last_name;
                    })
                    ->editColumn('email', function ($row) {
                        return $row->email;
                    })
                    ->editColumn('mobile_number', function ($row) {
                        $number = $row->country_code .'' .$row->mobile_no;
                        return $number;
                    })
                    ->editColumn('gender', function ($row) {
                        return $row->gender;
                    })
                    ->addColumn('action', function ($row) {
                        $delete =   route('employees.destroy', $row->id);

                        $editbutton = '<div class="c-pointer">
                                        <a href="' . route('employees.edit', $row->id) .'" title="Edit" class="btn btn-icon waves-effect me-2 btnLeftColor"><i class="fa-sharp fa-solid fa-pen"></i></a>
                                        </div>';

                        $deletebutton  = '<div class="c-pointer">
                                            <button data-href="' . $delete . '" method="delete" class="btn btn-icon waves-effect btnLeftColor delete_confirm">
                                                <i class="fa fa-trash"></i></a></div>
                                            </div>';
                        $action = '<div class="d-flex btnCenter">' . $editbutton . $deletebutton . ' </div>';
                        return $action;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('employee.index');
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('employees.index')
                ->with('error_message', 'Internal Server Error.Please Try Again Later!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'country_code' => 'required',
            'mobile_number' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $employee = new Employee;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->country_code = $request->country_code;
            $employee->mobile_no = $request->mobile_number;
            $employee->gender = $request->gender;
            $employee->hobby = json_encode($request->hobby);
            $employee->address = $request->address;
            if (isset($request->upload)) {
                $destinationPath = '/employee/';

                $file = $request->file('upload');
                $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/employee/', $fileName);
                $employee->photo = $fileName ?? '';
            }
            $execute = $employee->save();
            if (!$execute) {
                return redirect()->route('employees.create')
                    ->with('danger', 'Internal Server Error.Please Try Again Later!');
            }
            DB::commit();
            return redirect()->route('employees.index')
                ->with('success_message', 'Employees has been created successfully.');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('employees.index')
                ->with('error_message', 'Internal Server Error.Please Try Again Later!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        return view('employee.create',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'country_code' => 'required',
            'mobile_number' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $employee = Employee::where('id', $id)->first();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->country_code = $request->country_code;
            $employee->mobile_no = $request->mobile_number;
            $employee->gender = $request->gender;
            $employee->hobby = json_encode($request->hobby);
            $employee->address = $request->address;
            if (isset($request->upload)) {
                $destinationPath = '/employee/';

                $file = $request->file('upload');
                $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/employee/', $fileName);
                $employee->photo = $fileName ?? '';
            }
            $execute = $employee->update();
            if (!$execute) {
                return redirect()->route('employees.create')
                    ->with('danger', 'Internal Server Error.Please Try Again Later!');
            }
            DB::commit();
            return redirect()->route('employees.index')
                ->with('success_message', 'Employees has been updated successfully.');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('employees.index')
                ->with('error_message', 'Internal Server Error.Please Try Again Later!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employeeData = Employee::find($id);
        if (! $employeeData) {
            return $this->res->sendSweetAlertError("Oops!", "Something Went Wrong");

        }
        $employeeData->delete();
        return $this->res->sendSweetAlertSuccess("Deleted", trans('messages.msg.module.success', ['module' => 'Employees', 'action' => 'deleted']));

    }
}
