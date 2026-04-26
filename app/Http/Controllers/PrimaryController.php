<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimaryController extends Controller
{
    protected $GetRootAuthenticatedView = 'index-with-auth';
    protected function GetSessionData($keyArray='')
    {
        $sessionData = session()->all();
        $sessionData = $sessionData['app-praktikal'];

        if ($keyArray && $keyArray !== ''){
            if (isset($sessionData[$keyArray])){
                return $sessionData[$keyArray];
            }
            return null;
        }

        return $sessionData;
    }
}
