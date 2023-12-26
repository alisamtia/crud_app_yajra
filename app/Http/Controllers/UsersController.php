<?php

namespace App\Http\Controllers;
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('index');
    }

    public function update(){
        $attr=request()->validate([
            "edit_name"=>"required|min:3|max:225",
            "edit_email"=>"required|email|unique:users,email,".request("id"),
            "edit_password"=>"required|min:8|max:225"
        ]);

        User::where('id',request('id'))
        ->update([
                'name'=>request("edit_name"),
                'email'=>request("edit_email"),
                'password'=>bcrypt(request("edit_password"))
            ]);

        return back()->with("success","User Data Updated Successfully!");
    }

    public function create(){
        $attr=request()->validate([
            "create_name"=>"required|min:3|max:225",
            "create_email"=>"required|email|unique:users,email",
            "create_password"=>"required|min:8|max:225"
        ]);

        User::create([
                'name'=>request("create_name"),
                'email'=>request("create_email"),
                'password'=>bcrypt(request("create_password"))
            ]);

        return back()->with("success","User Data Added Successfully!");
    }

    public function delete(Request $request){
            $id=request("id");
            $record = user::find($id);

            if ($record) {
                $record->delete();
            }
            return back()->with('success',"Data Deleted Successfully");
    }
}
