<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PrimaryController;
use Illuminate\Http\Request;

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
                'users' => []
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
            'metadata' => $this->GetSessionData()
        ];
        
        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'metadata' => $this->GetSessionData()
        ];
        
        return view($this->GetRootAuthenticatedView, $dataBinding);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
