<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();

        return view('user', compact('users'));
    }

    public function calculate(Request $request){
        $Amount_Commission = $request->Amount_Commission;
        $Discount = $request->Discount;
        $Rate_VAT = $request->Rate_VAT;
       
        $Amount_Commission2 = $Amount_Commission - $Discount;

        if ($Amount_Commission === 'undefined' || !$Amount_Commission) {
            session()->flash('يرجي ادخال مبلغ العمولة ');
        } else {
            $intResults = $Amount_Commission2 * $Rate_VAT / 100;
            $intResults2 = floatval($intResults + $Amount_Commission2);
            $data['sumq'] = floatval($intResults);
            $data['sumt'] = floatval($intResults2);
            return response()->json($data);
        }
    }
}
