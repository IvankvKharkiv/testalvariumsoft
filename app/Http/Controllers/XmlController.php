<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employe;
use App\Models\Role;
use App\Models\Salary;
use DOMDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;



class XmlController extends Controller
{
    public function getImployeXmllite(Request $request){
        $bodydata = json_decode($request->header('httpload'));

        if($bodydata->pagination){
            if($bodydata->depid){
                $employescoll = Employe::where('department_id', $bodydata->depid)->with(['role', 'salary', 'department'])->paginate($bodydata->perPage, ['*'], 'page', $bodydata->page)->toArray();
            }else{
                $employescoll = Employe::with(['role', 'salary', 'department'])->paginate($bodydata->perPage, ['*'], 'page', $bodydata->page)->toArray();
            }
            $employescoll = $employescoll['data'];
        }else{
            $employescoll = Employe::with(['role', 'salary', 'department'])->get()->toArray();
        }
        
        
        
        $this->arraytoxlsnormalize($employescoll);

        $xmlDoc = new DOMDocument();
        $xmllist = $xmlDoc->appendChild($xmlDoc->createElement('employelist'));
        foreach($employescoll as $employe){
            if(!empty($employe)){
                $employechild = $xmllist->appendChild($xmlDoc->createElement('employe'));
                foreach($employe as $key=>$val){
                    $employechild->appendChild($xmlDoc->createElement($key, $val));
                }
            }
        }

        $xmlDoc->formatOutput = true;

        return response($xmlDoc->saveXML());
    }
    
    public function getImployeXml(){
        $employescoll = Employe::with(['role', 'salary', 'department'])->get()->toArray();
        $this->arraytoxlsnormalize($employescoll);

        $xmlDoc = new DOMDocument();
        $xmllist = $xmlDoc->appendChild($xmlDoc->createElement('employelist'));
        foreach($employescoll as $employe){
            if(!empty($employe)){
                $employechild = $xmllist->appendChild($xmlDoc->createElement('employe'));
                foreach($employe as $key=>$val){
                    $employechild->appendChild($xmlDoc->createElement($key, $val));
                }
            }
        }

        $xmlDoc->formatOutput = true;

        $result = $xmlDoc->saveXML();
        $filename = uniqid() . '.xml';
        Storage::put('xmlfiles/' . $filename, $result);

        return Storage::download('xmlfiles/' . $filename);
    }


    public function setImployeXml(Request $request, $asnew){
        // $xml = $request->getContent();
        try{
            $xml = new SimpleXMLElement($request->getContent());
        }catch(Exception $e){
            return response( json_encode(["error"=>"XML format corruped."]), 200)->header('Content-Type', 'text/plain');
        }

        $roles = Role::all('role')->toArray();
        $departments = Department::all('department')->toArray();

        $departments = array_column($departments, 'department');
        $roles = array_column($roles, 'role');
        
        $countempl = 0;
        $countnewempl = 0;
        $newdepartments=array();
        $newroles=array();


        for($i=0; $i<$xml->employe->count(); $i++){
            if($asnew){
                $xml->employe[$i]->id = null;
            }

            if((string)$xml->employe[$i]->id == null || (string)$xml->employe[$i]->id == ''){
                foreach($xml->employe[$i] as $k=>$v){                    
                    if($k=='role' && !in_array((string)$v, $roles) && !in_array((string)$v, $newroles)){
                        $newroles[]=(string)$v;
                    }
                    if($k=='department' && !in_array((string)$v, $departments) && !in_array((string)$v,$newdepartments) ){
                        $newdepartments[]=(string)$v;
                    }

                    $newemployes[$countnewempl][$k] = (string)$v;
                }
                $countnewempl++;
            }else{                
                foreach($xml->employe[$i] as $k=>$v){
                    if($k=='role' && !in_array((string)$v, $roles) ){
                        $newroles[]=(string)$v;
                    }
                    if($k=='department' && !in_array((string)$v, $departments) ){
                        $newdepartments[]=(string)$v;
                    }

                    $employes[$countempl][$k] = (string)$v;
                }
                $countempl++;
            }
        }

        if(isset($newroles)){
            foreach($newroles as $newrole){
                $rolesmodel = new Role();
                $rolesmodel->role = $newrole;
                $rolesmodel->save();
            }
        }

        if(isset($newdepartments)){
            foreach($newdepartments as $newdepartment){
                $departmentsmodel = new Department();
                $departmentsmodel->department = $newdepartment;
                $departmentsmodel->save();
            }            
        }

        $employesindb = Employe::with(['role', 'salary', 'department'])->get()->toArray();

        $this->arraytoxlsnormalize($employesindb);

        if(isset($employes)){
            foreach($employesindb as $employeindb){
                $dif = null;
                foreach($employes as $employe){
                    if($employeindb['id'] == $employe['id']){
                        $dif = array_diff($employeindb, $employe);
                        if(count($dif)>0){
                            $this->changeEmploye($employeindb, $employe);
                        }
                        break;
                    }
                }
            }
        }

        if(isset($newemployes)){
            foreach($newemployes as $newemploye){
                $this->createEmploye($newemploye);
            }
        }

        return response(json_encode("hello World"), 200)->header('Content-Type', 'text/plain');
    }


    private function arraytoxlsnormalize(&$arr){
        foreach($arr as $key=>$value){
            $arr[$key]['role'] = $arr[$key]['role']['role'];
            $arr[$key]['department'] = $arr[$key]['department']['department'];
            $arr[$key]['hours'] = $arr[$key]['salary']['hours'];
            $arr[$key]['hourly_wage'] = $arr[$key]['salary']['hourly_wage'];
            $arr[$key]['salary'] = $arr[$key]['salary']['salary'];
        }
    }

    private function createEmploye($newemploye){
        $employemodel = new Employe();
        $roleid = Role::where('role', $newemploye['role'])->first()->id;
        $depid = Department::where('department', $newemploye['department'])->first()->id;
        
        $employemodel->name = $newemploye['name'];
        $employemodel->lname = $newemploye['lname'];
        $employemodel->pname = $newemploye['pname'];
        $employemodel->bdate = $newemploye['bdate'];
        $employemodel->role_id = $roleid;
        $employemodel->department_id = $depid;
        $employemodel->save();

        $salary = new Salary();
        $salary->employe_id = $employemodel->id;
        $salary->hours = $newemploye['hours'];
        $salary->hourly_wage = $newemploye['hourly_wage'];
        $salary->save();
    }

    private function changeEmploye($employeindb, $employe){
        $empl = Employe::where('id', $employeindb['id'])->first();
        $roleid = Role::where('role', $employe['role'])->first()->id;
        $depid = Department::where('department', $employe['department'])->first()->id;
        $empl->name = $employe['name'];
        $empl->lname = $employe['lname'];
        $empl->pname = $employe['pname'];
        $empl->bdate = $employe['bdate'];
        $empl->role_id = $roleid;
        $empl->department_id = $depid;
        $empl->save();

        $salary = Salary::where('employe_id', $employeindb['id'])->first();
        $salary->employe_id = $empl->id;
        $salary->hours = $employe['hours'];
        $salary->hourly_wage = $employe['hourly_wage'];
        $salary->save();
    }


}
