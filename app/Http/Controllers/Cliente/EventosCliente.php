<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;

use App\Http\Requests;

class EventosCliente extends BaseCliente
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('cliente.eventos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['param'] = [
            'route' => 'cliente.evento.store',
            'class' => 'form-horizontal form-nuevo-evento',
            'role' => 'form',
            'autocomplete' => 'off'
        ];

        return $this->view('cliente.eventos.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEvento  $request
     * @return Response
     */
    public function store(EventosCliente $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
