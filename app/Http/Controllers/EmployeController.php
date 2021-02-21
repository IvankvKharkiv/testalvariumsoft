<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employe;
use App\Models\Salary;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

use function PHPUnit\Framework\isNull;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage = request('perPage', 10);
        $departments = Department::all();
        $dep =  null;
        $employes = Employe::paginate($perpage);
        return view('employelist', compact('employes', 'perpage', 'departments', 'dep'));
    }


    public function department($department){
        $perpage = request('perPage', 10);
        $departments = Department::all();
        $dep = Department::where('department', $department)->first();
        if(is_null($dep)){
            return redirect('employes');
        }
        $employes = Employe::where('department_id', $dep->id)->paginate($perpage);

        return view('employelist', compact('employes', 'perpage', 'dep', 'departments'));
    }


}
