@extends('template.layouts.default')

@section('title', $label->title)

@php
    $alert = false;
    if(ci()->session->flashdata('msg')){
        $alert = ci()->session->flashdata('msg');
    }
@endphp

@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
        @foreach ($label->breadcrumb as $i)
            <li class="breadcrumb-item"><a href="javascript:;">{{ucwords($i)}}</a></li>
        @endforeach
    </ol>
    <!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">{{ucwords($label->page_header->h5)}} 
            <small>{{ucwords($label->page_header->p)}}</small></h1>
    <!-- end page-header -->
	
	<!-- begin panel -->
	<div class="panel panel-warning">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        <h4 class="panel-title">Create Jadwal</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                    @includeWhen($alert, 'template.includes.component.notif', ['alert' => $alert])
            </div>
                <form action="{{route('pengisian.create')}}" method="POST">
                    <fieldset>
                        <div class="row">
                            @foreach ($kolom as $item)
                                @if ($item != 'id')
                                    @if ($item == 'tgl')
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="{{$item}}">TANGGAL</label>
                                                <input type="text" name="{{$item}}" class="form-control" id="datepicker-autoClose" />
                                            </div>
                                        </div>
                                    @elseif($item == 'composisi')
                                    <div class="col-4">
                                        <div class="form-group">
                                                <label for="{{$item}}">{{strtoupper($item)}}</label>
                                                <div class="input-group">
                                                    <input type="text" name="{{$item}}" class="form-control"  />
                                                    <div class="input-group-prepend"><span class="input-group-text">Kg</span></div>
                                                </div>
                                        </div>
                                    </div>
                                    @elseif($item == 'user_id')
                                        
                                    @elseif($item == 'customers_id')
                                    <div class="col-4">
                                        <div class="form-group">
                                                <label for="{{$item}}">PANGKALAN</label>
                                                <select class="default-select2 form-control" type="text" name="{{$item}}">
                                                    @foreach ($pangkalan as $item)
                                                        <option value="{{$item->id}}">{{$item->company}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    @else
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="{{$item}}">{{strtoupper($item)}}</label>
                                                <input type="text" name="{{$item}}" class="form-control" />
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            <div class="col-md-12 text-right">
                                    <div class="btn btn-group text-right">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                        <a href="{{route('pengisian')}}" class="btn btn-sm btn-warning">Cancel</a>
                                    </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
        </div>
        @dump($kolom)
	</div>
	<!-- end panel -->
@endsection

@push('css')
<link href="{{base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<link href="{{base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
<link href="{{base_url('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{base_url('assets/plugins/moment/moment.js')}}"></script>
<script src="{{base_url('assets/plugins/select2/dist/js/select2.min.js')}}"></script>
	<script>
        jQuery(function() {
            $(".default-select2").select2();
            $('.note-danger').fadeOut(6000)
            $('#datepicker-autoClose').datepicker({
                todayHighlight: true,
                autoclose: true,
                dateFormat: "yy-mm-dd"
            });
        })
    </script>
@endpush