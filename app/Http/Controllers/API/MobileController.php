<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ActeDeces;
use App\Models\ActeMariage;
use App\Models\ActeNaissance;
use App\Models\CopieIntegrale;
use App\Models\DateMariage;
use App\Models\DeclarationNaissance;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class MobileController extends Controller
{

    use ApiResponseHelpers;


    public function store_acte(Request $request)
    {
        Validator::validate($request->json()->all(), [
            'type_acte'=>'required'
        ]);

        switch ($request->input('type_acte')){
            case 'ActeDeces':
                return $this->create_acte_deces($request, new ActeDeces());
                break;
            case 'DeclarationNaissance':
                return $this->create_declaration_naissance($request, new DeclarationNaissance());
                break;
            case 'CopieIntegrale':
                return $this->create_copie_integral($request, new CopieIntegrale());
                break;
            case 'ActeNaissance':
                return $this->create_acte_naissance($request, new ActeNaissance());
                break;
            case 'ActeMariage':
                return $this->create_acte_marriage($request, new ActeMariage());
                break;
            case 'DateMariage':
                return $this->create_date_mariage($request, new DateMariage());
                break;
            default: return $this->respondForbidden();
        }

    }

    public function create_acte_deces(Request $request, ActeDeces $acteDeces): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        if($request->hasFile('pv_deces')){
            $acteDeces->pv_deces = $request->file('pv_deces')->storePublicly('pv_deces');
        }
        if($request->hasFile('piece_identite')){
            $acteDeces->piece_identite = $request->file('piece_identite')->storePublicly('piece_identites');
        }

        $acteDeces->fill($request->only([
            'owner','telephone','email','numero_piece','nom_defunt','prenoms_defunt',
            'lieu_naissance_defunt','date_naissance_defunt','type_piece','motif',
            'numero_acte','nb_copie','lieu'
        ]))
            ->save();

        return $this->respondCreated();
    }

    public function create_declaration_naissance(Request $request, DeclarationNaissance $declarationNaissance): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        if($request->hasFile('certificat_naissance')){
            $declarationNaissance->certificat_naissance = $request->file('certificat_naissance')->storePublicly('certificat_naissance');
        }
        if($request->hasFile('piece_identite_pere')){
            $declarationNaissance->piece_identite_pere = $request->file('piece_identite_pere')->storePublicly('piece_identite_pere');
        }
        if($request->hasFile('piece_identite_mere')){
            $declarationNaissance->piece_identite_mere = $request->file('piece_identite_mere')->storePublicly('piece_identite_mere');
        }

        $declarationNaissance->fill($request->only([
            'owner','telephone','email','nom_enfant','nom_defunt','prenoms_enfant',
            'lieu_naissance','date_naissance','type_piece','motif',
            'numero_acte','nb_copie','lieu','nom_pere','prenoms_pere','nom_mere','prenoms_mere',
        ]))
            ->save();

        return $this->respondCreated();
    }

    public function create_copie_integral(Request $request, CopieIntegrale $copieIntegrale):  JsonResponse
    {
        $data = $request->validate([
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        if($request->hasFile('extrait')){
            $copieIntegrale->extrait = $request->file('pv_deces')->storePublicly('pv_deces');
        }

        $copieIntegrale->fill($request->only([
            'owner','telephone','email','numero_piece','numero_acte','type_piece','motif',
            'numero_acte','nb_copie','lieu'
        ]))
            ->save();

        return $this->respondCreated();
    }

    public function create_acte_naissance(Request $request, ActeNaissance $acteNaissance): JsonResponse
    {
        $data = $request->validate([
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        if($request->hasFile('extrait')){
            $acteNaissance->extrait = $request->file('extrait')->storePublicly('extrait');
        }

        $acteNaissance->fill($request->only([
            'owner','telephone','email','numero_piece','numero_acte','type_piece','motif',
            'numero_acte','nb_copie','lieu'
        ]))
            ->save();

        return $this->respondCreated();
    }

    public function create_acte_marriage(Request $request, ActeMariage $acteMariage): JsonResponse
    {
        $data = $request->validate([
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        if($request->hasFile('extrait_mariage')){
            $acteMariage->extrait_mariage = $request->file('extrait_mariage')->storePublicly('extrait_mariage');
        }

        $acteMariage->fill($request->only([
            'owner','telephone','email','numero_piece','numero_acte','type_piece','motif',
            'numero_acte','nb_copie','lieu','nom_epoux','prenoms_epoux','nom_epouse','prenoms_epouse',
        ]))
            ->save();

        return $this->respondCreated();
    }

    public function create_date_mariage(Request $request, DateMariage $dateMariage): JsonResponse
    {
        $data = $request->validate([
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        if($request->hasFile('extrait')){
            $dateMariage->extrait = $request->file('extrait')->storePublicly('extrait');
        }

        if($request->hasFile('extrait_parent')){
            $dateMariage->extrait = $request->file('extrait_parent')->storePublicly('extrait_parent');
        }

        $dateMariage->fill($request->only([
            'owner','telephone','email','numero_piece','numero_acte','type_piece','motif',
            'numero_acte','nb_copie','lieu',
        ]))
            ->save();

        return $this->respondCreated();
    }
}
