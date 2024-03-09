<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Departmentmem;

use App\Models\Department;

use App\Models\Customer;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class DepartmentmemController extends Controller
{
    public function managedepartmentmem()
    {
        $department['all'] = Departmentmem::all();
        $department['departments'] = Department::select('pwa_department.id as deid', 'pwa_department.name as dename')->get();
        $department['members'] = Customer::select('customers.id as csid', 'customers.username as csname')->get();
        return view('admin.managedepartmentmem', compact('department'));
        
    }
    public function adddepartmentmem()
    {
        $data['departments'] = Department::select('pwa_department.id as deid', 'pwa_department.name as dename')->get();
        $data['members'] = Customer::select('customers.id as csid', 'customers.username as csname')->get();
        return view('admin.departmentmem', compact('data'));
        
    }
     public function departmentmem(Request $request)
    {
        $mem[] = $request->memid;
        
        $data['depid'] = $request->depid;
        $data['memid'] = $request->memid ? implode('|||', $request->memid) : " ";
        
        $data['status'] = $request->status ? "1" : "0";
        
        $departmentresult = DB::table('pwa_department_mem')->insert($data);
        if(!empty($departmentresult))
        {
           return redirect()->route('admindepartmentmem')->with ('succes', 'Department added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editdepartmentmem($id)
    {
        $department = Departmentmem::where('id', $id)->first();
        return view('admin.editdepartmentmem', compact('department'));
    }
    public function updatedepartmentmem(Request $request, $id)
    {
        $department['name'] =$request->name;
        $department['status'] = $request->status ? "1" : "0";
        
       $upded = DB::table('pwa_department_mem')->where('id', $id)->update($department);
        
        if(!empty($upded))
        {
          return redirect()->route('admindepartmentmem')->with ('succes', 'Department updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
    }
    public function deletedepartmentmem($id)
    {
        $deletd = DB::table('pwa_department_mem')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admindepartmentmem')->with ('succes', 'Department deleted successfully');
        }
        
    }
    public function viewdepartmentmem($id)
    {
        $department = DB::table('pwa_department_mem')->where('id', $id)->first();
        if(!empty($department))
        {
            return view('admin.viewdepartmentmem', compact('department'));
        }
        
    }
}