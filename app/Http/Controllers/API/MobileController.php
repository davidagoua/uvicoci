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
use Illuminate\Support\Facades\Storage;

class MobileController extends Controller
{

    use ApiResponseHelpers;


    public function store_acte(Request $request)
    {
        $data = Validator::validate($request->json()->all(), [
            'type_acte'=>'required'
        ]);

        switch ($request->json()->get('type_acte')){
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

        /*
       $data = Validator::validate($request->json()->all(), [
           'owner'=>'required|boolean',
           'email'=>'required|email',
           'telephone'=>'required',
       ]);
       // return $request->json()->all();

       $data = $request->validate([
           'owner'=>'required|boolean',
           'email'=>'required|email',
           'telephone'=>'required',
       ]);

        */
        $this->store_blob_file($acteDeces, 'pv_deces', 'pv_deces');
        $this->store_blob_file($acteDeces, 'piece_identite', 'piece_identites');
        
        
        $request->json()->remove('type_acte');
        $request->json()->remove('pv_deces');
        $request->json()->remove('piece_identite');
        
        $acteDeces->fill($request->json()->all());


        
        $acteDeces->save();

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    public function create_declaration_naissance(Request $request, DeclarationNaissance $declarationNaissance): \Illuminate\Http\JsonResponse
    {   
        /*
        $data = Validator::validate($request->json()->all(), [
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);
        */
        if($request->hasFile('certificat_naissance')){
            $declarationNaissance->certificat_naissance = $request->file('certificat_naissance')->storePublicly('certificat_naissance');
        }
        if($request->hasFile('cni_pere')){
            $declarationNaissance->cni_pere = $request->file('cni_pere')->storePublicly('cni_pere');
        }
        if($request->hasFile('cni_mere')){
            $declarationNaissance->cni_mere = $request->file('cni_mere')->storePublicly('cni_mere');
        }
        $request->json()->remove('type_acte');
        $request->json()->remove('cni_pere');
        $request->json()->remove('cni_mere');
        $request->json()->remove('certificat_naissance');
        $declarationNaissance->fill($request->json()->all());
        
        $declarationNaissance->save();

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    public function create_copie_integral(Request $request, CopieIntegrale $copieIntegrale):  JsonResponse
    {
        /*
        $data = Validator::validate($request->json()->all(), [
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);
        */
            if($request->hasFile('extrait')){
            $copieIntegrale->extrait = $request->file('extrait')->storePublicly('extrait');
        }
        $request->json()->remove('extrait');
        $copieIntegrale->fill($request->json()->all())->save();
        
        

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    public function create_acte_naissance(Request $request, ActeNaissance $acteNaissance): JsonResponse
    {
        /*
        $data = Validator::validate($request->json()->all(), [
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);
        */  
        if($request->hasFile('extrait')){
            $acteNaissance->extrait = $request->file('extrait')->storePublicly('extrait');
        }
        $request->json()->remove('extrait');
        $acteNaissance->fill($request->json()->all())->save();

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    public function create_acte_marriage(Request $request, ActeMariage $acteMariage): JsonResponse
    {
        $data = Validator::validate($request->json()->all(), [
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

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    public function create_date_mariage(Request $request, DateMariage $dateMariage): JsonResponse
    {
        $data = Validator::validate($request->json()->all(), [
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

        $dateMariage->fill($request->json([
            'owner','telephone','email','numero_piece','numero_acte','type_piece','motif',
            'numero_acte','nb_copie','lieu',
        ]))
            ->save();

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    private function store_blob_file(&$object, $file, $directory)
    {
        if (request()->json()->has($file)) {
            // Récupérer le contenu base64
            $base64File = request()->json()->get($file);
            
            // Enlever le préfixe "data:image/png;base64," si présent
            if (preg_match('/^data:image\/(\w+);base64,/', $base64File, $type)) {
                $base64File = substr($base64File, strpos($base64File, ',') + 1);
            }
            
            // Décoder le base64
            $fileData = base64_decode($base64File);
            
            // Générer un nom de fichier unique
            $fileName = uniqid() . '.' . 'pdf'; // ou l'extension appropriée
            
            // Sauvegarder le fichier
            Storage::disk('public')->put($directory . '/' . $fileName, $fileData);
            
            // Sauvegarder le chemin dans la base de données
            $object->$file = $directory . '/' . $fileName;
        }
    }
}
