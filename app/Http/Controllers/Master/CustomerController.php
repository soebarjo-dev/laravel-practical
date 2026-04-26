<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\PrimaryController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends PrimaryController
{
    private $indexView = 'master.customers.index';
    private $formView = 'master.customers.form';
    private $detailView = 'master.customers.detail';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBinding = [
            'subview' => $this->indexView,
            'metadata' => $this->GetSessionData(),
            'data' => [
                'customers' => Customer::all()
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
            'formActionURL' => route('master-customers.store'),
            'formActionMethod' => "POST",
            'label' => [
                'formTitle' => 'Tambah Pelanggan',
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
            'email' => 'required|email:rfc,dns|max:100',
        ];
        $validated = $request->validate($rules);

        // 2. CREATE CUSTOMER
        $dataMapping = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'created_by' => $this->GetSessionData('user_id'),
            'updated_by' => 0,
            'deleted_by' => 0,
        ];
        Customer::create($dataMapping);

        // 3. REDIRECT KE MASTER CUSTOMER LISTS
        return redirect()->route('master-customers.index')->with('success','Pembuatan Pelanggan Berhasil');
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
            'formActionURL' => route('master-customers.update', ['customer' => $id]),
            'formActionMethod' => "PUT",
            'label' => [
                'formTitle' => 'Edit Pelanggan',
                'submitButton' => 'Ubah'
            ],
            'data' => [
                'customer' => Customer::find($id)->toArray()
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
            'email' => 'required|email:rfc,dns|max:100',
        ];
        $validated = $request->validate($rules);

        // 2. CARI CUSTOMER DAN CEK
        $customer = Customer::where('id', $id)->first();
        if (!$customer){
            return redirect()->route('master-customers.index')->with('error','Pelanggan Tidak Ditemukan');
        }

        // 3. UPDATE
        $dataMapping = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'updated_by' => $this->GetSessionData('user_id'),
        ];

        $customer->update($dataMapping);

        // 4. REDIRECT KE HALAMAN LIST
        return redirect()->route('master-customers.index')->with('success','Perubahan Data Pelanggan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. CARI CUSTOMER
        $customer = Customer::where('id', $id)->first();
        if (!$customer){
            return redirect()->route('master-customers.index')->with('error','Pelanggan Tidak Ditemukan');
        }

        // 2. UPDATE LOG
        $dataMapping = [
            'deleted_by' => $this->GetSessionData('user_id'),
        ];
        $customer->update($dataMapping);

        // 3. DELETE
        $customer->delete();

        // 4. REDIRECT
        return redirect()->route('master-customers.index')->with('success','Hapus Data Pelanggan Berhasil');
    }
}
