<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResourcee;
use App\Models\Servico;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicoController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return ServiceResourcee::collection(Servico::all());
    }



    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'tipo'=> 'required|string|max:255',
            'preco'=> 'required',
            'duracao' =>'required|date_format:H:i'
        ]);

        if ($validator->fails()) {
            return $this->error('Servico data invalid',422, $validator->errors());
        }
        
        $create = Servico::create($validator->validate());
        
        if($create){
            return $this->response('Serviço created success',200, new ServiceResourcee($create));
        }
        return $this->error('Servico not created',400, $create);
    }


    public function show($id)
    {
        return new ServiceResourcee(Servico::where('id',$id)->first());
    }


    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[
            'tipo'=> 'required|string|max:255',
            'preco'=> 'required',
            'duracao'  =>'required|date_format:H:i'
        ]);

        if ($validator->fails()) {
            return $this->error('Servico data invalid',422, $validator->errors());
        }

        $validated = $validator->validate();
        
        $servico = Servico::find($id);

        $update = $servico->update([
            'tipo'=> $validated['tipo'],
            'preco'=> $validated['preco'],
            'duracao'=> $validated['duracao'],
        ]);
        if ($update) {
            return $this->response('Serviço update success', 200,  new ServiceResourcee($servico));
        }
        return $this->error('Serviço not update', 400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $servico = Servico::find($id);

        $deleted = $servico->delete();

        if ($deleted) {
            return $this->response('Serviço deleted success', 200);
        }
        return $this->response('Serviço not deleted', 200);
    }
}
