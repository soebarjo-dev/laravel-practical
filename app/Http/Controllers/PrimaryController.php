<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimaryController extends Controller
{
    protected $GetRootAuthenticatedView = 'index-with-auth';
    protected function GetSessionData()
    {
        $sessionData = session()->all();
        return $sessionData['app-praktikal'];
    }
}