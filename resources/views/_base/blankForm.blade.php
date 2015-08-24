@extends('_base.main')

{{-- Adjuntar los links css de los plugins requeridos
@section('plugins-css')@stop --}}

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

{{-- Contenido de la vista. --}}
@section('content')
      <div class="row">
            <div class="col-md-12">
                  <!-- BEGIN SAMPLE FORM PORTLET-->
                  <div class="portlet box green ">
                        <div class="portlet light animated bounceInUp">
                              <div class="caption">
                                    <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> Horizontal Form</span>
                                    <span class="caption-helper"> Horizontal Form</span>
                              </div>
                              <div class="tools">
                                    <a href="" class="collapse">
                                    </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config">
                                    </a>
                                    <a href="" class="reload">
                                    </a>
                                    <a href="" class="remove">
                                    </a>
                              </div>
                        </div>
                        <div class="portlet-body form">
                              <form class="form-horizontal" role="form">
                                    <div class="form-body">
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Block Help</label>

                                                <div class="col-md-9">
                                                      <input type="text" class="form-control" placeholder="Enter text">
                                                      <span class="help-block">A block of help text. </span>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Inline Help</label>

                                                <div class="col-md-9">
                                                      <input type="text" class="form-control input-inline input-medium" placeholder="Enter text">
                                                      <span class="help-inline">Inline help. </span>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Input Group</label>

                                                <div class="col-md-9">
                                                      <div class="input-inline input-medium">
                                                            <div class="input-group">
                                                                  <span class="input-group-addon">
                                                                        <i class="fa fa-user"></i>
                                                                  </span>
                                                                  <input type="email" class="form-control" placeholder="Email Address">
                                                            </div>
                                                      </div>
                                                      <span class="help-inline">Inline help. </span>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Email Address</label>

                                                <div class="col-md-9">
                                                      <div class="input-group">
                                                            <span class="input-group-addon">
                                                                  <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="email" class="form-control" placeholder="Email Address">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Password</label>

                                                <div class="col-md-9">
                                                      <div class="input-group">
                                                            <input type="password" class="form-control" placeholder="Password">
                                                            <span class="input-group-addon">
                                                                  <i class="fa fa-user"></i>
                                                            </span>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Left Icon</label>

                                                <div class="col-md-9">
                                                      <div class="input-icon">
                                                            <i class="fa fa-bell-o"></i>
                                                            <input type="text" class="form-control" placeholder="Left icon">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Right Icon</label>

                                                <div class="col-md-9">
                                                      <div class="input-icon right">
                                                            <i class="fa fa-microphone"></i>
                                                            <input type="text" class="form-control" placeholder="Right icon">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Icon Input in Group Input</label>

                                                <div class="col-md-9">
                                                      <div class="input-group">
                                                            <div class="input-icon">
                                                                  <i class="fa fa-lock fa-fw"></i>
                                                                  <input id="newpassword" class="form-control" type="text" name="password" placeholder="password"/>
                                                            </div>
                                                            <span class="input-group-btn">
                                                                  <button id="genpassword" class="btn btn-success" type="button">
                                                                        <i class="fa fa-arrow-left fa-fw"/></i> Random
                                                                  </button>
                                                            </span>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Input With Spinner</label>

                                                <div class="col-md-9">
                                                      <input type="password" class="form-control spinner" placeholder="Password">
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Static Control</label>

                                                <div class="col-md-9">
                                                      <p class="form-control-static">
                                                            email@example.com
                                                      </p>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Disabled</label>

                                                <div class="col-md-9">
                                                      <input type="password" class="form-control" placeholder="Disabled" disabled>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Readonly</label>

                                                <div class="col-md-9">
                                                      <input type="password" class="form-control" placeholder="Readonly" readonly>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Dropdown</label>

                                                <div class="col-md-9">
                                                      <select class="form-control">
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                            <option>Option 4</option>
                                                            <option>Option 5</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Multiple Select</label>

                                                <div class="col-md-9">
                                                      <select multiple class="form-control">
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                            <option>Option 4</option>
                                                            <option>Option 5</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Textarea</label>

                                                <div class="col-md-9">
                                                      <textarea class="form-control" rows="3"></textarea>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label for="exampleInputFile" class="col-md-3 control-label">File input</label>

                                                <div class="col-md-9">
                                                      <input type="file" id="exampleInputFile">

                                                      <p class="help-block">
                                                            some help text here.
                                                      </p>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Checkboxes</label>

                                                <div class="col-md-9">
                                                      <div class="checkbox-list">
                                                            <label>
                                                                  <input type="checkbox"> Checkbox 1 </label>
                                                            <label>
                                                                  <input type="checkbox"> Checkbox 1 </label>
                                                            <label>
                                                                  <input type="checkbox" disabled> Disabled </label>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Inline Checkboxes</label>

                                                <div class="col-md-9">
                                                      <div class="checkbox-list">
                                                            <label class="checkbox-inline">
                                                                  <input type="checkbox" id="inlineCheckbox21" value="option1"> Checkbox 1
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                  <input type="checkbox" id="inlineCheckbox22" value="option2"> Checkbox 2
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                  <input type="checkbox" id="inlineCheckbox23" value="option3" disabled> Disabled
                                                            </label>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Radio</label>

                                                <div class="col-md-9">
                                                      <div class="radio-list">
                                                            <label>
                                                                  <input type="radio" name="optionsRadios" id="optionsRadios22" value="option1" checked> Option 1
                                                            </label>
                                                            <label>
                                                                  <input type="radio" name="optionsRadios" id="optionsRadios23" value="option2" checked> Option 2
                                                            </label>
                                                            <label>
                                                                  <input type="radio" name="optionsRadios" id="optionsRadios24" value="option2" disabled> Disabled
                                                            </label>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Inline Radio</label>

                                                <div class="col-md-9">
                                                      <div class="radio-list">
                                                            <label class="radio-inline">
                                                                  <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked> Option 1
                                                            </label>
                                                            <label class="radio-inline">
                                                                  <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked> Option 2
                                                            </label>
                                                            <label class="radio-inline">
                                                                  <input type="radio" name="optionsRadios" id="optionsRadios27" value="option3" disabled> Disabled
                                                            </label>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-actions">
                                          <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                      <button type="submit" class="btn green">Submit</button>
                                                      <button type="button" class="btn default">Cancel</button>
                                                </div>
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
                  <!-- END SAMPLE FORM PORTLET-->
            </div>
      </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js
@section('plugins-core-js')@stop --}}

{{-- Cargar los archivos de js
@section('page-level-js')@stop --}}

{{-- Inicializo los js
@section('init-js')@stop --}}