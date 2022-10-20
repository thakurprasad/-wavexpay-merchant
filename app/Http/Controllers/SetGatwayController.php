<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetGatwayController extends Controller
{
    public function setGatwayMode($mode){
        try{
            session()->put('mode', $mode);         
            return redirect()->back();
         } catch (\Exception $e) {
            return redirect()->back()->withErrors("Error: ".$e->getMessage());
        }
    }
}
