<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends PrimaryController
{
    private $indexView = 'transaction.index';
    private $formView = 'transaction.form';
    private $detailView = 'transaction.detail';

    public function index()
    {
        $dataBinding = [
            'subview' => $this->indexView,
            'metadata' => $this->GetSessionData(),
            'data' => [
                'products' => Transaction::with('items.product')->get()->toArray()
            ]
        ];

        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    public function create()
    {
        $dataBinding = [
            'subview' => $this->formView,
            'metadata' => $this->GetSessionData(),
            'formActionURL' => route('master-transactions.store'),
            'formActionMethod' => "POST",
            'label' => [
                'formTitle' => 'Buat Transaksi',
                'submitButton' => 'Simpan'
            ],
            'data' => []
        ];

        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    public function store(Request $request)
    {

    }

    public function detail(string $id)
    {
        $dataBinding = [
            'subview' => $this->detailView,
            'metadata' => $this->GetSessionData()
        ];

        return view($this->GetRootAuthenticatedView, $dataBinding);
    }
}
