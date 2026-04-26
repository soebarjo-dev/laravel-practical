<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\PrimaryController;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends PrimaryController
{
    private $indexView = 'master.products.index';
    private $formView = 'master.products.form';
    private $detailView = 'master.products.detail';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBinding = [
            'subview' => $this->indexView,
            'metadata' => $this->GetSessionData(),
            'data' => [
                'products' => Product::select('id','unit_id','name','price')
                    ->with('unit:id,name,symbol')->get()->toArray()
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
            'formActionURL' => route('master-products.store'),
            'formActionMethod' => "POST",
            'label' => [
                'formTitle' => 'Tambah Produk',
                'submitButton' => 'Simpan'
            ],
            'data' => [
                'units' => Unit::all()->select('id','name','symbol')->toArray()
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
            'unit_id' => 'required|integer|exists:units,id',
            'price' => 'required|decimal:0',
        ];
        $messages = [
            'decimal' => 'Hanya dapat menggunakan desimal 2 angka'
        ];
        $validated = $request->validate($rules, $messages);

        // 2. CREATE PRODUCT
        $dataMapping = [
            'name' => $validated['name'],
            'unit_id' => $validated['unit_id'],
            'price' => $validated['price'],
            'created_by' => $this->GetSessionData('user_id'),
            'updated_by' => 0,
            'deleted_by' => 0,
        ];
        Product::create($dataMapping);

        // 3. REDIRECT KE MASTER PRODUCT LISTS
        return redirect()->route('master-products.index')->with('success','Pembuatan Produk Berhasil');
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
            'formActionURL' => route('master-products.update', ['product' => $id]),
            'formActionMethod' => "PUT",
            'label' => [
                'formTitle' => 'Edit Produk',
                'submitButton' => 'Ubah'
            ],
            'data' => [
                'product' => Product::select('id','unit_id','name','price')->find($id)->toArray(),
                'units' => Unit::all()->toArray()
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
            'unit_id' => 'required|integer|exists:units,id',
            'price' => 'required|decimal:0',
        ];
        $validated = $request->validate($rules);

        // 2. CARI PRODUCT DAN CEK
        $product = Product::where('id', $id)->first();
        if (!$product){
            return redirect()->route('master-products.index')->with('error','Produk Tidak Ditemukan');
        }

        // 3. UPDATE
        $dataMapping = [
            'name' => $validated['name'],
            'unit_id' => $validated['unit_id'],
            'price' => $validated['price'],
            'updated_by' => $this->GetSessionData('user_id'),
        ];

        $product->update($dataMapping);

        // 4. REDIRECT KE HALAMAN LIST
        return redirect()->route('master-products.index')->with('success','Perubahan Data Produk Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. CARI PRODUK
        $product = Product::where('id', $id)->first();
        if (!$product){
            return redirect()->route('master-products.index')->with('error','Produk Tidak Ditemukan');
        }

        // 2. UPDATE LOG
        $dataMapping = [
            'deleted_by' => $this->GetSessionData('user_id'),
        ];
        $product->update($dataMapping);

        // 3. DELETE
        $product->delete();

        // 4. REDIRECT
        return redirect()->route('master-products.index')->with('success','Hapus Data Produk Berhasil');
    }
}
