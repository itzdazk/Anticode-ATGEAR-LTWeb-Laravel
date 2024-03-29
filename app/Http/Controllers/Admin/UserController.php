<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
            'role_as' => ['required', 'integer'],
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role_as' => $request->role_as,
        ]);

        return redirect('admin/users')->with('message', 'Tạo thành công');
    }


    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $userId)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8',],
            'role_as' => ['required', 'integer'],
        ]);

        User::FindOrFail($userId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role_as' => $request->role_as,
        ]);


        return redirect('admin/users')->with('message', 'Cập nhật thành công');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('admin/users')->with('message', 'Cập nhật thành công');
    }
}
