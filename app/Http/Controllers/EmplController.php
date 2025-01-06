<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmplController extends Controller
{
    public function index()
    {
        $data = Emp::all();
        return $data;
    }

    public function addEmp(request $requesst)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required | min:10',
            'age' => 'required | max:2'
        );

        $validation = Validator::make($requesst->all(), $rules);

        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $emp = new Emp();
            $emp->name = $requesst->name;
            $emp->email = $requesst->email;
            $emp->phone = $requesst->phone;
            $emp->age = $requesst->age;

            if ($emp->save()) {
                return ['resualt' => 'data saved'];
            } else {
                return ['resualt' => 'operation failed'];
            }
        }
    }

    public function updateEmp(request $request)
    {

        $rules = array(
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required | min:10',
            'age' => 'required | max:2'
        );
        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return $validate->errors();
        } else {
            $find = Emp::find($request->id)->first();
            $find->name = $request->name;
            $find->email = $request->email;
            $find->phone = $request->phone;
            $find->age = $request->age;

            if ($find->save()) {
                return ['result' => 'data updated successfully'];
            } else {
                return ['result' => 'operation failed'];
            }
        }
    }

    public function deleteEmp($id)
    {
        $delete = Emp::destroy($id);
        if ($delete) {
            return ['result' => 'data delete successfully'];
        } else {
            return ['result' => 'operation failed'];
        }
    }
}
