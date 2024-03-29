<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //index
    public function index(Request $request){
        //get users with page
        $users = DB::table('users')
            ->where('name', 'like', '%'.$request->search.'%')
            ->paginate(5);
        return view('pages.users.index', compact('users'));
    }

    //create
    public function create(){
        return view('pages.users.create');
    }

    //store
    public function store(Request $request){
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        User::create($data);
        return redirect()->route('user.index');
    }

    //show
    public function show($id){

    }

    //edit
    public function edit($id){
        $user = User::findorFail($id);
        return view('pages.users.edit', compact('user'));

    }

    //update
    public function update(Request $request , $id){
        $data = $request->all();
        $user = User::findorFail($id);
        //Check if password not empty
        if(!empty($data['password'])){
            $data['password'] = Hash::make($request->input('password'));
        }else{
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('user.index');
    }

    //destroy
    public function destroy($id){
        $user = User::findorFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }

}
