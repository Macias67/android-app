<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * Interface CRUDInterface
 *
 * @author  Luis Macias
 * @package App\Interfaces
 */
interface CRUDInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index();

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create();

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    //public function store(Request $request);

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id);

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id);

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id);

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id);
}