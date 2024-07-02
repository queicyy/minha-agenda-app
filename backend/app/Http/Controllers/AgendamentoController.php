<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgendamentoResource;
use App\Models\Agendamento;
use App\Models\ClienteServico;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgendamentoController extends Controller
{
    private $pagamentos = ['C' => 'Crédito', 'D' => 'Débito', 'P' => 'Pix', 'Dinheiro' => 'Dinheiro'];
    use HttpResponse;
    public function index()
    {
        //$agendamentos AgendamentoResource::collection(Agendamento::all());
        return AgendamentoResource::collection(Agendamento::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'profissional_id' => 'required',
            'data' => 'required|date',
            'hora' => 'required',
            'status' => 'required|numeric|between:0,1',
            'pagamento' => 'required|in:C,D,P,Di',
            'preco' => 'required|numeric',
            'data_pagamento' => 'nullable|date_format:Y-m-d H:i:s', // opcional dependendo do cenário
        ]);

        $agendamento = Agendamento::create($request->all());

        return response()->json($agendamento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamento $agendamento)
    {
        return response()->json($agendamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        $request->validate([
            'cliente_id' => 'required',
            'profissional_id' => 'required',
            'data' => 'required|date',
            'hora' => 'required',
            'status' => 'required|numeric|between:0,1',
            'pagamento' => 'required|in:C,D,P,Di',
            'preco' => 'required|numeric',
            'data_pagamento' => 'nullable|date_format:Y-m-d H:i:s', // opcional dependendo do cenário
        ]);

        $agendamento->update($request->all());

        return response()->json($agendamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
        $agendamento->delete();

        return response()->json(null, 204);
    }
}
