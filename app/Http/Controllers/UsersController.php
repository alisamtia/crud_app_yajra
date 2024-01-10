<?php

namespace App\Http\Controllers;
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('index');
    }

    public function update(UserRequest $request,User $user){
        $validated_data=$request->validated();

        $user->update([
                'name'=>$validated_data["edit_name"],
                'email'=>$validated_data["edit_email"],
                'password'=>bcrypt($validated_data["edit_password"])
            ]);

        return back()->with("success","User Data Updated Successfully!");
    }

    public function create(UserRequest $request){
        $request->validated();

        User::create([
                'name'=>request("create_name"),
                'email'=>request("create_email"),
                'password'=>bcrypt(request("create_password"))
            ]);

        return back()->with("success","User Data Added Successfully!");
    }

    public function delete(User $user){
            $user->delete();
            return back()->with('success',"Data Deleted Successfully");
    }
}
