<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Categorias;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Producto;
use App\Http\Requests;
use App\Http\Requests\CreateProducto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductosCliente extends BaseCliente
{
    public function __construct()
    {
        parent::__construct();
        $this->data['activo_productos'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id',  'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }
        $this->data['negocios'] = $options;
        $this->data['param'] = [
            'class'     => 'form-control',
            'ng-model'  => 'idCliente',
            'ng-change' => 'showProductos(idCliente, $element.target)',
            'data-url'  => route('cliente.producto.procutos-json')
        ];
        return $this->view('cliente.productos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['param'] = [
            'route'        => 'cliente.producto.store',
            'class'        => 'form-horizontal form-nuevo-producto',
            'role'         => 'form',
            'autocomplete' => 'off'
        ];

        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id',  'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }
        $this->data['negocios'] = $options;

        return $this->view('cliente.productos.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateProducto $request
     *
     * @return \App\Http\Controllers\Cliente\Response
     */
    public function store(CreateProducto $request)
    {
        if($request->ajax() && $request->wantsJson()){
           $producto = new Producto;
            $producto->preparaDatos($request);

            if ($producto->save()) {
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Producto registrado',
                    'texto'  =>'¡Felicidades! <b>' . $producto->nombre . '</b> se ha registrado.',
                    'url'    => route('productos-cliente')
                ];
            }
            else {
                $response = [
                    'exito'  => FALSE,
                    'titulo' =>  'No se registró',
                    'texto'  =>'Parece que no hubo registro en la BD',
                    'url'    => NULL
                ];
            }
            return $this->responseJSON($response);
        }
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

    public function getProductosJson ($id)
    {
        $categoria = new Categorias;
        $categorias = $categoria->where('cliente_id', $id)->get();

        $final = [];
        foreach($categorias as $categoria) {
            $productos = $categoria->productos->toArray();

            $arrayProductos = [];
            foreach ($productos as $key => $producto) {
                array_push($arrayProductos, $producto);
            }

            $allCategorias = [];
            $allCategorias['categoria'] = $categoria['categoria'];
            $allCategorias['productos'] = $arrayProductos;
            array_push($final, $allCategorias);
        }

        return new JsonResponse($final);
    }
}
