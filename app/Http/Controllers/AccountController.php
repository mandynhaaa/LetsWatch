<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', 
        ];
        $validated = $request->validate($rules);
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }
        $user->fill($updateData);
        $user->save();
        return back()->with('success', 'Dados da conta atualizados com sucesso!');
    }
}