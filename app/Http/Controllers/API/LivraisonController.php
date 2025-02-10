<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Termwind\Components\Li;

class LivraisonController extends Controller
{
    use ApiResponseHelpers;
    public function checkStatus(Request $request, string $type, int $id)
    {
        $livraison =  Livraison::query()->firstWhere(['document_id'=>$id])->andWhere(['document_type'=>$type]);
        if($livraison){
            return $this->respondOk(json_encode([
                'status' => $livraison->status,
            ]));
        }
        return $this->respondNotFound(json_encode([]));
    }
}
