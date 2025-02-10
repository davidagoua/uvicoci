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
        $this->store_blob_file($declarationNaissance, 'certificat_naissance', 'certificat_naissance');
        $this->store_blob_file($declarationNaissance, 'cni_pere', 'cni_pere');
        $this->store_blob_file($declarationNaissance, 'cni_mere', 'cni_mere');

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
        $this->store_blob_file($copieIntegrale, 'extrait', 'extrait');
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
        $this->store_blob_file($acteNaissance, 'extrait', 'extrait');
        $request->json()->remove('extrait');
        $acteNaissance->fill($request->json()->all())->save();

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    public function create_acte_marriage(Request $request, ActeMariage $acteMariage): JsonResponse
    {
         Validator::validate($request->json()->all(), [
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        $this->store_blob_file($acteMariage, 'extrait_mariage', 'extrait_mariage');

        $acteMariage->fill($request->json()->all())
            ->save();

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    public function create_date_mariage(Request $request, DateMariage $dateMariage): JsonResponse
    {
        Validator::validate($request->json()->all(), [
            'owner'=>'required|boolean',
            'email'=>'required|email',
            'telephone'=>'required',
        ]);

        $this->store_blob_file($dateMariage, 'extrait', 'extrait');

        $this->store_blob_file($dateMariage, 'extrait_parent', 'extrait_parent');

        $dateMariage->fill($request->json()->all())
            ->save();

        return $this->respondCreated([
            "message"=>"item created",
        ]);
    }

    private function store_blob_file(&$object, $file, $directory)
    {
        if (request()->json()->has($file)) {
            $base64File = request()->json()->get($file);

            $extension = 'jpg';

            if (preg_match('/^data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+);base64,/', $base64File, $matches)) {
                $mime_type = $matches[1];
                $mime_to_ext = [
                    'application/pdf' => 'pdf',
                    'image/jpeg' => 'jpg',
                    'image/jpg' => 'jpg',
                    'image/png' => 'png',
                    'image/gif' => 'gif',
                    'application/msword' => 'doc',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
                ];

                if (isset($mime_to_ext[$mime_type])) {
                    $extension = $mime_to_ext[$mime_type];
                }

            }

            $base64File = substr($base64File, strpos($base64File, ',') + 1);
            Storage::disk('public')->put('piece_identite/log.txt', $extension);
            Storage::disk('public')->put('piece_identite/b64.txt', $base64File);
            $fileData = base64_decode($base64File);

            $fileName = uniqid() . '.' . $extension;


            Storage::disk('public')->put($directory . '/' . $fileName, $fileData);

            $object->$file = $directory . '/' . $fileName;
        }
    }
}
