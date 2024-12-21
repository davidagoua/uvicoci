<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ActeDeces;
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

        switch ($request->input('type_acte')){
            case 'ActeDeces':
                return $this->create_acte_deces($request, new ActeDeces());
                break;
            default: return $this->respondForbidden();
        }

    }

    public function create_acte_deces(Request $request, ActeDeces $acteDeces): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'owner'=>'required',
            'email'=>'required|email',
            'telepone'=>'required',
        ]);

        if($request->hasFile('pv_deces')){
            $acteDeces->pv_deces = $request->file('pv_deces')->storePublicly('pv_deces');
        }
        if($request->hasFile('piece_identite')){
            $acteDeces->pv_deces = $request->file('piece_identite')->storePublicly('piece_identites');
        }

        $acteDeces->fill($data)
            ->fill($request->input())
            ->save();

        return $this->respondCreated();
    }
}
