<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResouce;
use App\Models\Clientes;
use App\Traits\HttpResponse;
use Illuminate\Foundation\Console\CliDumper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    use HttpResponse;
    public function index()
    {
        
        return ClienteResouce::collection(Clientes::all());
    }

    public function getAllClientesWithServices()
    {
        $clientes = Clientes::with('servicos')->get();
        return ClienteResouce::collection($clientes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',
            'email' => 'required|email|string|max:255',
            'aniversario'=> 'required|date_format:Y-m-d',
   
        ]);

        if ($validator->fails()) {
            return $this->error('Data Invalid', 422, $validator->errors());
        }

        $cliente = Clientes::create($validator->validated());

        if ($request->has('servicos')) {
            $cliente->servicos()->attach($request->servicos);
        }

        return $this->response('Cliente created', 200, new ClienteResouce($cliente));
    }

    public function show($id)
    {
        return new ClienteResouce(Clientes::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',
            'email' => 'required|email|string|max:255',
            'aniversario'=> 'required|date_format:Y-m-d',
  
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $cliente = Clientes::findOrFail($id);
        $cliente->update($validator->validated());

        if ($request->has('servicos')) {
            $cliente->servicos()->sync($request->servicos);
        }

        return $this->response('Cliente updated', 200, new ClienteResouce($cliente));
    }

    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);
 
        $cliente->delete();

        return $this->response('Cliente deleted', 200);
    }
}
