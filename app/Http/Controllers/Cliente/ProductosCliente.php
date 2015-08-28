<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Categorias;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Producto;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests;
use App\Http\Requests\CreateProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        $cl_productos = Producto::getTableName();
        $cl_clientes = Cliente::getTableName();
        $cl_propietario = Propietario::getTableName();

        $productos = DB::table($cl_productos)
            ->select(
                $cl_productos.'.id',
                $cl_clientes.'.id as cliente_id',
                $cl_clientes.'.nombre as nombre_cliente',
                $cl_productos.'.nombre as nombre_producto',
                $cl_productos.'.descripcion_corta',
                DB::raw('COUNT(usr_usuario_gusta_producto.producto_id) AS totalLikes')
            )
            ->join($cl_clientes, $cl_productos.'.cliente_id', '=', $cl_clientes.'.id')
            ->join($cl_propietario, $cl_clientes.'.propietario_id', '=', $cl_propietario.'.id')
            ->join('usr_usuario_gusta_producto', $cl_productos.'.id', '=', 'usr_usuario_gusta_producto.producto_id')
            ->where($cl_propietario.'.id', '=', $this->infoPropietario->id)
            ->groupBy($cl_productos.'.nombre')
            ->orderBy('totalLikes', 'DESC')
            ->take(10)
            ->get();

        foreach($productos as $producto) {
            $producto->imagen = $this->_getImaageProducto($producto->id);
        }

//        dd($productos);

        $this->data['productosMasGustados'] = $productos;

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
                    'url' => route('productos-cliente')
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
        $producto = Producto::find($id);
        $this->data['producto'] = $producto;
        $this->data['img_producto'] = $this->_getImaageProducto($id);
        $this->data['current_cliente_id'] = $id;
        return $this->view('cliente.productos.perfil.settings');
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

    private function  _getImaageProducto ($id)
    {
        $files = File::files('img/cliente/' . $id . '/productos');
        $logoDefault = asset('assets/admin/pages/media/productos/producto.jpg');
        $count = count($files);
        if ($count > 1 || $count == 0) {
            if ($count > 1) {
                foreach ($files as $file) {
                    unlink($file);
                }
            }

            return asset($logoDefault);
        }
        else if ($count == 1) {
            list($width, $height) = getimagesize($files[0]);
            if ($width != 500 || $height != 500) {
                unlink($files[0]);

                return asset($logoDefault);
            }
            else if ($width == 500 && $height == 500) {
                return asset($files[0]);
            }
        }
    }
}
