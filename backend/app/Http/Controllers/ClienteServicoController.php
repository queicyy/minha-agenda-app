<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResouce;
use App\Http\Resources\ClienteServicoResource;
use App\Models\ClienteServico;
use Illuminate\Http\Request;

class ClienteServicoController extends Controller
{
    public function index(){
     
        return ClienteServicoResource::collection(ClienteServico::all());
        //return ClienteServico::all();
    }
}
