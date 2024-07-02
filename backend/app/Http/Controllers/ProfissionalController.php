<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfissionalResource;
use App\Models\Profissional;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfissionalController extends Controller
{
   use HttpResponse;
    public function index()
    {
        return ProfissionalResource::collection(Profissional::all());
    }

  
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nome'=> 'required|string|max:255',
            'telefone'=> 'required| string| max:15',
            'email'=> 'required|email|string|max:255' 
        ]);

        if ($validator->fails()){
            return $this->error('Data Invalid', 422, $validator->errors());
        }

        $create = Profissional::create($validator->validate());

        if($create){
            return $this->response('Profissional created', 200,  new ProfissionalResource($create));
        }
        
        return $this->error('Profissional not created', 400, $create);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new ProfissionalResource(Profissional::where('id',$id)->first());
    }

    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[
            'nome'=> 'required|string|max:255',
            'telefone'=> 'required| string| max:15',
            'email'=> 'required|email|string|max:255'

        ]);

     

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }
        
        $validated = $validator->validate();

        $profissional = Profissional::find($id);

        $updated= $profissional->update([
            'nome'=> $validated['nome'],
            'telefone'=> $validated['telefone'],
            'email'=> $validated['email'],
        ]);

        if ($updated) {
            return $this->response('Profissional update success', 200,  new ProfissionalResource($profissional));
        }
        return $this->error('Profissional not update', 400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profissional = Profissional::find($id);

        $deleted= $profissional->delete();

        if ($deleted) {
            return $this->response('Profissional deleted success', 200);
        }
        return $this->response('Profissional not deleted', 200);

    }
}
