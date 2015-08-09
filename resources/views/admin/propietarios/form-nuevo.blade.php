@extends('admin.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
      <h1>Registro de nuevo cliente
            <small>Información básica del cliente</small>
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
                  <a href="#">Clientes</a>
                  <i class="fa fa-circle"></i>
            </li>
            <li>
                  <a href="#">Nuevo</a>
            </li>
      </ul>
@stop

{{-- Conteindo de la vista. --}}
@section('content')
      <div class="row">
            <div class="col-md-6">
                  <!-- BEGIN Portlet PORTLET-->
                  <div class="portlet light animated bounceInUp">
                        <div class="portlet-title">
                              <div class="caption">
                                    <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> Propietario</span>
                                    <span class="caption-helper">Registro de propietario</span>
                              </div>
                              <div class="actions">
                                    <a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
                              </div>
                        </div>
                        <div class="portlet-body form">
                              {!! Form::open($param) !!}
                              <div class="form-body">
                                    <div class="form-group">
                                          <label class="col-md-3 control-label">Nombre(s)</label>
                                          <div class="col-md-9">
                                                <div class="input-icon">
                                                      <i class="fa fa-user"></i>
                                                      <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)">
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="col-md-3 control-label">Apellido(s)</label>
                                          <div class="col-md-9">
                                                <div class="input-icon">
                                                      <i class="fa fa-user"></i>
                                                      <input type="text" class="form-control" name="apellido" placeholder="Apellido(s)">
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="control-label col-md-3">Género</label>
                                          <div class="col-md-9">
                                                <input type="checkbox" class="make-switch" name="genero" checked
                                                       data-size="small"
                                                       data-on-text="<i class='fa fa-male'></i>" data-off-text="<i class='fa fa-female'></i>"
                                                       data-on-color="info"
                                                       data-off-color="danger">
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="col-md-3 control-label">Móvil</label>
                                          <div class="col-md-9">
                                                <div class="input-icon input-small">
                                                      <i class="fa fa-mobile"></i>
                                                      <input type="text" class="form-control" name="movil" placeholder="Móvil">
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="col-md-3 control-label">Email</label>
                                          <div class="col-md-9">
                                                <div class="input-icon input-large">
                                                      <i class="fa fa-envelope"></i>
                                                      <input type="text" class="form-control" name="email" placeholder="Email">
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="col-md-3 control-label">Password</label>
                                          <div class="col-md-9">
                                                <div class="input-group input-large">
                                                      <div class="input-icon">
                                                            <i class="fa fa-lock fa-fw"></i>
                                                            <input id="newpassword" class="form-control" type="text" name="password" placeholder="Password"/>
                                                      </div>
                                                            <span class="input-group-btn">
                                                                  <button id="genpassword" class="btn btn-success" type="button">
                                                                        <i class="fa fa-arrow-left fa-fw"/></i> Generar
                                                                  </button>
                                                            </span>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="control-label col-md-3">Estatus</label>
                                          <div class="col-md-9">
                                                <input type="checkbox" class="make-switch" name="estatus" checked
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
                                                <button type="submit" class="btn green">Guardar</button>
                                          </div>
                                    </div>
                              </div>
                              </form>
                        </div>
                  </div>
                  <!-- END Portlet PORTLET-->
            </div>
      </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
{!! \Html::script('assets/global/plugins/jquery-inputmask/dist/inputmask/jquery.inputmask.min.js', array('type' => 'text/javascript')) !!}
{!! \Html::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js', array('type' => 'text/javascript')) !!}
{!! \Html::script('assets/global/plugins/jquery-validation/js/localization/messages_es.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Cargar los archivos de js  --}}
@section('page-level-js')
{!! \Html::script('assets/admin/pages/app/admin/propietarios/nuevo-propietario.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Inicializo los js --}}
@section('init-js')
      NuevoPropietario.init();
@stop