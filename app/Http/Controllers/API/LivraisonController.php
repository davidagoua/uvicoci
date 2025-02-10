<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use Illuminate\Http\Request;
use Termwind\Components\Li;

class LivraisonController extends Controller
{
    public function check_status(Request $request, string $type, int $id)
    {
        return Livraison::query()->firstWhere(['document_id'=>$id])->andWhere(['document_type'=>$type])->status();
    }
}
