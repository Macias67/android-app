@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos--}}
@section('plugins-css')
    <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
    <h1>Registro de nuevo evento
        <small>Información del evento</small>
    </h1>
@stop

{{-- Sobreescribir el toolbar de pagina
@section('page-toolbar')@stop --}}

{{-- Sobreescribir el breadcrumb de pagina --}}
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

{{-- Contenido de la vista. --}}
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light animated bounceInUp">
                <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech"></i>
                    <span class="caption-subject bold uppercase"> EVENTO</span>
                    <span class="caption-helper"> Registro de evento</span>
                </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    {!! Form::open($param) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nombre del evento: </label>
                                <div class="col-md-9">
                                    <div class="input-icon">
                                        <i class="fa fa-institution"></i>
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre del evento">
                                        <input type="hidden" name="propietario_id" value="{{$user->id}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="display:none;" class="col-md-3 control-label">Slug <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-icon">
                                        <i style="display:none;" class="fa fa-desktop"></i>
                                        <input type="hidden" class="form-control" name="slug" placeholder="Url del producto" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Descripción</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="referencia" rows="3" style="resize: none;"></textarea>
                                    <span class="help-block">Descripción del evento. </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Horario </label>
                                <div class="col-md-8">
                                    <div class="input-group" id="defaultrange" name="daterange">
                                        <input type="text" class="form-control">
                                            <span class="input-group-btn">
                                            <button class="btn default date-range-toggle" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Dirección</label>
                                <div class="col-md-9">
                                    <div class="input-icon">
                                        <i class="fa fa-map-marker"></i>
                                        <input type="text" class="form-control" name="calle" placeholder="Dirección">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Cupo</label>
                                <div class="col-md-9">
                                    <div class="input-inline input-medium">
                                        <input id="cantidad" type="text" name="cantidad" class="form-control" value="0">
                                    </div>
                                    <span class="help-block">Personas</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Precio</label>
                                <div class="col-md-9">
                                    <div class="input-inline input-medium">
                                        <input id="precio" type="text" name="precio" class="form-control">
                                    </div>
                                </div>
                            </div>

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

                            <div class="form-group">
                                <label class="control-label col-md-3">Estatus</label>
                                <div class="col-md-9">
                                    <div class="margin-bottom-10">
                                        <label for="option1">Próximo</label>
                                        <input id="option1" type="radio" name="radio1" value="option1" class="make-switch switch-radio1">
                                    </div>
                                    <div class="margin-bottom-10">
                                        <label for="option2">Ahora&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <input id="option2" type="radio" name="radio1" value="option2" class="make-switch switch-radio1">
                                    </div>
                                    <div class="margin-bottom-10">
                                        <label for="option3">Nunca&nbsp;&nbsp;&nbsp;</label>
                                        <input id="option3" type="radio" name="radio1" value="option3" class="make-switch switch-radio1">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Disponible</label>
                                <div class="col-md-9">
                                    <input type="checkbox" class="make-switch" name="estatus"
                                           data-size="small"
                                           data-on-text="Online" data-off-text="Offline"
                                           data-on-color="success"
                                           data-off-color="default">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js--}}
@section('plugins-core-js')
    <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js')}}" type="text/javascript"></script>
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