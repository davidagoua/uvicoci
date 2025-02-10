<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Services\DocumentUtils;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Termwind\Components\Li;

class LivraisonController extends Controller
{
    use ApiResponseHelpers;
    public function checkStatus(Request $request, string $type, int $id)
    {
        $type_document = DocumentUtils::getModelByType($type);
        $livraison = $type_document::query()->where('id_document', '=', $id); ;
        if($livraison){
            return $this->respondWithSuccess([
                'status' => DocumentUtils::statusCodeToString($livraison->status),
            ]);
        }
        return $this->respondNotFound(json_encode([]));
    }
}
