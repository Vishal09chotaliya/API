<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Studentcontroller extends Controller
{
    public function list()
    {
        return Student::all();
    }

    public function addUser(request $req)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required | min:10'
        );

        $validation = Validator::make($req->all(), $rules);

        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $user = new Student();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->phone = $req->phone;

            if ($user->save()) {
                return ['status' => 'data save successfully'];
            } else {
                return ['status' => 'operation failed'];
            }
        }
    }

    public function update(request $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        if ($student->save()) {
            return ['status' => 'data updated success'];
        } else {
            return ['status' => 'operation failed'];
        }
    }

    public function deleteUser($id)
    {
        $student = Student::find($id);

        if ($student->delete()) {
            return ['status' => 'user delete success'];

        } else {
            return ['status' => 'user delete failed'];
        }
    }

    public function searchStudent($id)
    {
        // return $id;

        $student = Student::find($id);

        if ($student) {
            return $student;
        } else {
            return ['status' => 'Student not found'];
        }
    }
}
