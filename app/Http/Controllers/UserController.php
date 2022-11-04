<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $roles = Role::all();
        return view('user/index', compact('user', 'roles'));
    }

    public function add()
    {
        $roles = Role::all();
        return view('user/add', compact( 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'password' => 'required',
                'roleId' => 'required'
            ]
        );
        if($request->password !== $request->verifPassword) return redirect()->route('user.add')->with('verifPassword', 'Verif Password Tidak cocok')->with(old());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'roleId' => $request->roleId,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('user.index')->with('massage', 'User berhasi ditambahkan');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        if(!$user) { return redirect()->route('user.index');}

        $roles = Role::all();
        return view('user/edit', compact( 'roles', 'user'));
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'roleId' => 'required'
            ]
        );

        $user = User::where('id', $request->id)->first();
        $password = $user->password;

        if ($request->password) {
            if($request->password !== $request->verifPassword) return redirect()->route('user.add')->with('verifPassword', 'Verif Password Tidak cocok')->with(old());
            $password = Hash::make($request->password);
        }

        User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'roleId' => $request->roleId
            ]);
        return redirect()->route('user.index')->with('massage', 'User berhasi di Update');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if(!$user) { return redirect()->route('user.index');}
        User::destroy($user->id);

        return redirect()->route('user.index')->with('massage', 'User ' . $user->name . ' berhasi Dihapus');
    }
}
