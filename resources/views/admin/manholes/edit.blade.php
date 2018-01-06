@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($manholes, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.manholes.update', $manholes->id))) !!}

<div class="form-group">
    {!! Form::label('feat_num', 'Feat num', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('feat_num', old('feat_num',$manholes->feat_num), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('name', 'Naziv okna', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$manholes->name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('district', 'Opština', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('district', old('district',$manholes->district), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('subdistrict', 'Podnaselje', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('subdistrict', old('subdistrict',$manholes->subdistrict), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('address', 'Ulica i broj', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('address', old('address',$manholes->subdistrict), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('latitude', 'Geografska širina', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('latitude', old('latitude',$manholes->latitude), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('longitude', 'Geografska dužina', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('longitude', old('longitude',$manholes->longitude), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('description', 'Opis okna', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('description', old('description',$manholes->description), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('num_entries', 'Broj ulaza', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('num_entries', old('num_entries',$manholes->num_entries), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.manholes.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection