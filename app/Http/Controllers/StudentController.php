<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    function list(){
        return Student::all();
    }

    function addStudent(Request $req){
        $rules  = array('first_name' => 'required | min:2 | max:20',
                        'email' => 'required | email',
                        'age' => 'numeric'
                    );

        $validation = Validator::make($req->all(), $rules);

       if($validation->fails()){
            return $validation->errors();
       } else {
            $student = new Student();
            $student->first_name = $req->first_name;
            $student->email = $req->email;
            $student->age = $req->age;
        
            if($student->save()){
                return $student;
            } else {
                return ["Result" => "Operation failed"];
            }
        }
    }
    function updateStudent (Request $req){

        

        $student = Student::find($req->id);
        $student->first_name = $req->first_name;
        $student->email = $req->email;
        $student->age = $req->age;
        
        if($student->save()){
            return $student;
        } else {
            return ["Result" => "Operation failed"];
        }
    }

    function deleteStudent($id){
        $student = Student::destroy($id); 
        if($student){
            return ["Result" => "Student has been deleted"];
        } else {
            return ["Result" => "Operation failed"];
        }
    }
    function searchStudent ($name){
        $student = Student::where('first_name', 'like', '%'.$name.'%')->get();
      
        if(count($student) > 0){
            return  ["Result" => $student];
        } else {
            return ["Result" => "Student not found"];
        }
    }
}