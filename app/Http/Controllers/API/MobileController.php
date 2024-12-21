<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobileController extends Controller
{

    use ApiResponseHelpers;


    public function store_acte(Request $request)
    {
        Validator::validate($request->input(), [
            'type_acte'=>'required'
        ]);
        if(!$request->filled('type_acte')){
            $this->respondError("Le champ type_acte doit être fournis");
        }
    }
}
