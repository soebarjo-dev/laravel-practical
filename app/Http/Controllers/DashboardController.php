<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends PrimaryController
{
    public function index(){
        $dataBinding = [
            'subview' => 'dashboard.index',
            'metadata' => $this->GetSessionData()
        ];
        
        return view($this->GetRootAuthenticatedView, $dataBinding);
    }
}
