<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class FlashControlle extends Gestion
{
    public function flash(Request $request)
    {
        return view('flash.fff')->with('request',$request);
    }

    public function errorsFlash(Request $request)
    {
        var_dump($request->all());
        $request->flash();

        return redirect()->back()->withInput();
    }
}
