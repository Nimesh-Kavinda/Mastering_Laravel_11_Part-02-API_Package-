<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    function list(){
        return Student::all();
    }

    // function addStudent(Request $request){
    //     return $request->input();
    // }

    function addStudent(Request $request){

        $rules = array(
            "name" => "required | min:2 | max:20" ,
            "email" => "required | email" ,
            "phone" => "required | max:9" ,
        );

        $validation = Validator::make($request->all() , $rules);

        if($validation->fails()){
            return $validation->errors();
        } else {

            $student = new Student();

            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
    
            if($student->save()){
                return ["result" => "New Student Added"];
            } else {
                return ["result" => "New Student Not Added"];
            }

        }

    }

        function updateStudent(Request $request){

           $student = Student::find($request->id);
           $student->name = $request->name;
           $student->email = $request->email;
           $student->phone = $request->phone;

           if($student->save()){

            return ["result" => "New Student Updated"];

              } else {

             return ["result" => "New Student Not updated"];
            }

        }


        function deleteStudent($id){
            $student = Student::destroy($id);

            if($student){
                return ["result" => "Student Deletd"];
            } else {
                return ["result" => "Student Not Deletd"];
            }
        }


        function searchStudent($name){
            $student = Student::where('name', 'like', "%$name%")->get();

            if($student){
                return ["result" => $student];
            }else {
                return ["result" => "No Data Found"];

            }

        }

}
