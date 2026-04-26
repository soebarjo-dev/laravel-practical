<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\PrimaryController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends PrimaryController
{
    private $indexView = 'master.users.index';
    private $formView = 'master.users.form';
    private $detailView = 'master.users.detail';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBinding = [
            'subview' => $this->indexView,
            'metadata' => $this->GetSessionData(),
            'data' => [
                'users' => User::all()
            ]
        ];

        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataBinding = [
            'subview' => $this->formView,
            'metadata' => $this->GetSessionData(),
            'formActionURL' => route('master-users.store'),
            'formActionMethod' => "POST",
            'label' => [
                'formTitle' => 'Tambah Pengguna',
                'submitButton' => 'Simpan'
            ]
        ];

        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'created_by' => $this->GetSessionData('user_id'),
            'updated_by' => 0,
            'deleted_by' => 0,
        ];
        User::create($dataMapping);

        // 3. REDIRECT KE MASTER USER LISTS
        return redirect()->route('master-users.index')->with('success','Pembuatan User Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataBinding = [
            'subview' => $this->detailView,
            'metadata' => $this->GetSessionData()
        ];

        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataBinding = [
            'subview' => $this->formView,
            'metadata' => $this->GetSessionData(),
            'formActionURL' => route('master-users.update', ['user' => $id]),
            'formActionMethod' => "PUT",
            'label' => [
                'formTitle' => 'Edit Pengguna',
                'submitButton' => 'Ubah'
            ],
            'data' => [
                'user' => User::find($id)->toArray()
            ]
        ];

        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. VALIDASI
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email:rfc,dns|max:100|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6'
        ];
        $validated = $request->validate($rules);

        // 2. CARI USER DAN CEK
        $user = User::where('email', $validated['email'])->first();
        if (!$user){
            return redirect()->route('master-users.index')->with('error','Pengguna Tidak Ditemukan');
        }

        // 3. UPDATE
        $dataMapping = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'updated_by' => $this->GetSessionData('user_id'),
        ];

        if ($validated['password'] && $validated !== null && $validated['password'] !== ''){
            $dataMapping['password'] = Hash::make($validated['password']);
        }

        $user->update($dataMapping);

        // 4. REDIRECT KE HALAMAN LIST
        return redirect()->route('master-users.index')->with('success','Perubahan Data User Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. CARI USER
        $user = User::where('id', $id)->first();
        if (!$user){
            return redirect()->route('master-users.index')->with('error','Pengguna Tidak Ditemukan');
        }

        // 2. UPDATE LOG
        $dataMapping = [
            'deleted_by' => $this->GetSessionData('user_id'),
        ];
        $user->update($dataMapping);

        // 3. DELETE
        $user->delete();

        // 4. REDIRECT
        return redirect()->route('master-users.index')->with('success','Hapus Data User Berhasil');
    }
}
