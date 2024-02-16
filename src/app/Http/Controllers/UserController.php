<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users(){
        $users = User::all();
        return view('users' , compact('users'));
    }

    public function __construct(){
        $this->middleware('admin')->only(['create','store', 'index', 'edit', 'update', 'destroy']);
    }

    public function index(){
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'admin_flag' => 'required|boolean',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'admin_flag' => $request->admin_flag,
        ]);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully!');
}

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'admin_flag' => 'required|boolean',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->admin_flag = $request->admin_flag;
        $user->save();

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }
}
