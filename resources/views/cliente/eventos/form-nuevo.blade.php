@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos--}}
@section('plugins-css')
    <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css"/>
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de página--}}
@section('page-title')
    <h1>Registro de nuevo evento
        <small>Información del evento</small>
    </h1>
@stop

{{-- Sobreescribir el toolbar de página
@section('page-toolbar')@stop --}}

{{-- Sobreescribir el breadcrumb de página --}}
@section('page-breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="">Inicio</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Eventos</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Nuevo</a>
        </li>
    </ul>
@stop

{{-- Contenido de la vista --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light animated bounceInUp">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-calendar"></i>
                        <span class="caption-subject bold uppercase"> Evento</span>
                        <span class="caption-helper"> Registro de evento</span>
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    {!! Form::open($param) !!}
                    <div class="col-md-6">
                        <div class="form-body">
                            <!-- Negocio -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Negocio <span class="required">*</span></label>
                                <div class="col-md-9">
                                    {!! Form::select('cliente_id', $negocios, NULL, ['class' => 'form-control', 'data-url' => route('cliente-select-categorias')]) !!}
                                </div>
                                <input type="hidden" name="cliente_id" value="{{$user->id}}">
                            </div>
                            <!-- Nombre del evento -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nombre del evento <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-icon">
                                        <i class="fa fa-institution"></i>
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre del evento">
                                    </div>
                                </div>
                            </div>
                            <!-- Slug -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Slug <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-icon">
                                        <i class="fa fa-desktop"></i>
                                        <input type="text" class="form-control" name="slug" placeholder="Slug" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- Descripción -->
                            <div class="form-group">
                                <label class="control-label col-md-3">Descripción <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="descripcion" maxlength="255" rows="3" style="resize: none;"></textarea>
                                    <span class="help-block">Descripción del evento. </span>
                                </div>
                            </div>
                            <!-- Cupo -->
                            <div class="form-group">
                                <label class="control-label col-md-3">Cupo</label>
                                <div class="col-md-9">
                                    <div class="input-inline input-medium">
                                        <input id="cantidad" type="text" name="cupo" class="form-control" value="0">
                                    </div>
                                </div>
                            </div>
                            <!-- Precio -->
                            <div class="form-group">
                                <label class="control-label col-md-3">Precio</label>
                                <div class="col-md-9">
                                    <div class="input-inline input-medium">
                                        <input id="precio" type="text" name="costo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Dirección -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Dirección</label>
                                <div class="col-md-9">
                                    <div class="input-icon">
                                        <i class="fa fa-map-marker"></i>
                                        <input type="text" class="form-control" name="direccion" placeholder="Dirección">
                                    </div>
                                    <span class="help-block">Ejemplo: Cuarzo No. 9A, Ocotlán</span>
                                </div>
                            </div>
                            <!-- Latitud y Longitud -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Latitud y Longitud</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="gmap_geocoding_address" placeholder="Dirección completa...">
                                            <span class="input-group-btn">
                                                  <button class="btn blue" id="gmap_geocoding_btn"><i class="fa fa-map-marker"></i></button>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="text" class="form-control" placeholder="Readonly" name="latlng_gmaps" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <div id="gmap_geocoding" class="gmaps"> </div>
                                    <span class="help-block">El indicador es solo una referencia muy cercana al lugar. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Estatus -->
                        <div class="form-group">
                            <label class="control-label col-md-3">Estatus<span class="required">*</span></label>
                            <div class="col-md-9">
                                <div class="clearfix">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input id="option1" type="radio" name="estatus" class="toggle" value="proximo" checked> Próximo </label>
                                        <label class="btn btn-default">
                                            <input id="option2" type="radio" name="estatus" class="toggle" value="ahora"> Ahora </label>
                                        <label class="btn btn-default">
                                            <input id="option3" type="radio" name="estatus" class="toggle" value="caduco"> Caduco </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Disponible -->
                        <div class="form-group">
                            <label class="control-label col-md-3">Disponible<span class="required">*</span></label>
                            <div class="col-md-9">
                                <input type="checkbox" class="make-switch" name="disponible"
                                   data-size="small"
                                   data-on-text="Online" data-off-text="Offline"
                                   data-on-color="success"
                                   data-off-color="default" checked>
                            </div>
                        </div>
                        <!-- URL externa extra -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Url externa</label>
                            <div class="col-md-9">
                                <div class="input-icon">
                                    <i class="fa fa-institution"></i>
                                    <input type="text" class="form-control" name="url_exterior" placeholder="Url externa">
                                </div>
                            </div>
                        </div>
                        <!-- Horario -->
                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn default" id="reportrange">
                                    <i class="fa fa-calendar">
                                        </i> Horario<i class="fa fa-angle-down">
                                    </i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Inicio <span class="required">*</span></label>
                            <div class="col-md-9">
                                <div class="input-icon">
                                    <i class="fa fa-calendar"></i>
                                    <input type="text" class="form-control" name="finicio"  readonly>
                                    <input type="hidden" class="form-control" name="fecha_inicio">
                                    <input type="hidden" class="form-control" name="hora_inicio">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Final <span class="required">*</span></label>
                            <div class="col-md-9">
                                <div class="input-icon">
                                    <i class="fa fa-calendar"></i>
                                    <input type="text" class="form-control" name="ffin" readonly>
                                    <input type="hidden" class="form-control" name="fecha_termina">
                                    <input type="hidden" class="form-control" name="hora_termina">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botón registrar -->
                    <div class="col-md-12">
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-11">
                                        <button type="submit" class="btn bg-green-meadow btn-lg">Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
@stop

{{-- Sobreescribir el encabezado de página
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js--}}
@section('plugins-core-js')
    <script src="{{asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/moment-with-locales.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js')}}" type="text/javascript"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/gmaps/gmaps.min.js')}}" type="text/javascript"></script>
@stop

{{-- Cargar los archivos de js--}}
@section('page-level-js')
    <script src="{{asset('assets/admin/pages/app/cliente/eventos/nuevo-evento.js')}}" type="text/javascript"></script>
@stop

{{-- Inicializo los js --}}
@section('init-js')
    NuevoEvento.init();
@stop