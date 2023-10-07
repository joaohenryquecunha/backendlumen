<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'admin' => 'required'
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->admin = $request->input('admin');
        $user->password = app('hash')->make($request->input('password'));
        $user->save();

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update($id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $users->update(request()->all());

        return response()->json(['message' => 'Funcionário atualizado com sucesso']); 
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Funcionário excluído com sucesso']);
    }
}

