<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function IndexSignIn()
    {
        $dataBinding = [
            'titlePage' => 'Autentikasi Masuk',
            'subview' => 'authentication.content-sign-in'
        ];

        return view('index-non-auth', $dataBinding);
    }

    public function IndexRegister()
    {
        $dataBinding = [
            'titlePage' => 'Pendaftaran',
            'subview' => 'authentication.content-register'
        ];

        return view('index-non-auth', $dataBinding);
    }

    public function ProcessRegister(Request $request)
    {
        // 1. VALIDASI
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email:rfc,dns|max:100|unique:users,email',
            'password' => 'required|string|min:6'
        ];
        $validated = $request->validate($rules);

        // 2. CREATE USER
        $dataMapping = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'created_by' => 0,
            'updated_by' => 0,
            'deleted_by' => 0,
        ];
        User::create($dataMapping);

        // 3. REDIRECT TO LOGIN PAGE
        return redirect()->route('sign-in.index')->with('success','Registrasi Berhasil');
    }

    public function ProcessSignIn(Request $request)
    {
        // 1. VALIDASI
        $rules = [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:6'
        ];
        $validated = $request->validate($rules);

        // 2. CARI USER
        $user = User::where('email', $validated['email'])->first();
        if (!$user){
            $arrayMessages = [
                'email' => 'User tidak ditemukan'
            ];
            return back()->withErrors($arrayMessages)->withInput();
        }

        // 3. CEK PASSWORD MENGGUNAKAN HASHING / ENKRIPSI
        // 123456 -> ENKRIPSI -> abcde1 -> DEKRIPSI -> 123456
        // 123456 -> abcde1
        // ENKRIPSI
        // INPUTAN === DECRYPT(password)
        // HASHING
        // HASHING(INPUTAN) === password, password_verify
        if (!Hash::check($request->password, $user->password)){
            $arrayMessages = [
                'password' => 'Password salah'
            ];
            return back()->withErrors($arrayMessages)->withInput();
        }

        // 4. SUKSES LOGIN
        // SIMPAN DATA DI SESSION
        $bindingSession = [
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_id' => $user->id
        ];
        session(['app-praktikal' => $bindingSession]);

        // REDIRECT
        return redirect()->route('dashboard.index');
    }

    public function ProcessSignOut()
    {
        // CLEAR SESSION
        session()->flush();
        return redirect()->route('sign-in.index');
    }
}
