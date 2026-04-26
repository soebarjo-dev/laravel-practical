<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\PrimaryController;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UnitController extends PrimaryController
{
    private $indexView = 'master.units.index';
    private $formView = 'master.units.form';
    private $detailView = 'master.units.detail';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBinding = [
            'subview' => $this->indexView,
            'metadata' => $this->GetSessionData(),
            'data' => [
                'units' => Unit::all()
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
            'formActionURL' => route('master-units.store'),
            'formActionMethod' => "POST",
            'label' => [
                'formTitle' => 'Tambah Unit',
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
            'name' => 'required|string|max:50',
            'symbol' => 'required|max:20|unique:units,symbol',
        ];
        $validated = $request->validate($rules);

        // 2. CREATE USER
        $dataMapping = [
            'name' => $validated['name'],
            'symbol' => $validated['symbol'],
            'created_by' => $this->GetSessionData('user_id'),
        ];
        Unit::create($dataMapping);

        // 3. REDIRECT KE MASTER USER LISTS
        return redirect()->route('master-units.index')->with('success','Pembuatan Unit Berhasil');
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
            'formActionURL' => route('master-units.update', ['unit' => $id]),
            'formActionMethod' => "PUT",
            'label' => [
                'formTitle' => 'Edit Unit',
                'submitButton' => 'Ubah'
            ],
            'data' => [
                'unit' => Unit::find($id)->toArray()
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
            'name' => 'required|string|max:50',
            'symbol' => 'required|max:20|unique:units,symbol,'.$id,
        ];
        $validated = $request->validate($rules);

        // 2. CARI USER DAN CEK
        $unit = Unit::where('id', $id)->first();
        if (!$unit){
            return redirect()->route('master-units.index')->with('error','Unit Tidak Ditemukan');
        }

        // 3. UPDATE
        $dataMapping = [
            'name' => $validated['name'],
            'symbol' => $validated['symbol'],
        ];

        $unit->update($dataMapping);

        // 4. REDIRECT KE HALAMAN LIST
        return redirect()->route('master-units.index')->with('success','Perubahan Data Unit Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. CARI USER
        $unit = Unit::where('id', $id)->first();
        if (!$unit){
            return redirect()->route('master-units.index')->with('error','Unit Tidak Ditemukan');
        }

        // 2. DELETE
        $unit->delete();

        // 4. REDIRECT
        return redirect()->route('master-units.index')->with('success','Hapus Data Unit Berhasil');
    }
}
