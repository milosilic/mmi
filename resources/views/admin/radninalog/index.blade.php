@extends('admin.layouts.master')

@section('content')
    <script type="application/javascript">

        var locations = [];

        function initMap() {
            console.log(locations[0]);
                var belgrade = {lat: 44.1, lng: 22.2};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 17,
                    center: locations[0]
                });

            // Create an array of alphabetical characters used to label the markers.
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var bounds = new google.maps.LatLngBounds();
            var markers = locations.map(function(location, i) {
                let tempMarker = new google.maps.Marker({
                    position: location,
                    map:map,
                    label: labels[i % labels.length]
                });
                bounds.extend(tempMarker.getPosition());
                return tempMarker;

            });


            map.fitBounds(bounds);

            function addMarker(location) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
                markerCluster.addMarker(marker);
            }

        }

        function addMarkerToArray(element) {
            locations.push(element);
            console.log(element);
        }


    </script>

<p>{!! link_to_route(config('quickadmin.route').'.radninalog.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($radninalog->count())
    <div id="table" class="portlet box green col-md-6">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Ime operatera</th>
<th>Naziv okna</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($radninalog as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ isset($row->user->name) ? $row->user->name : '' }}</td>
<td>{{ isset($row->manholes->name) ? $row->manholes->name : '' }}</td>

                            <td>
                                <a href="{{ route('admin.radninalog.show',[$row->id]) }}" class="btn btn-xs btn-primary">View</a>
                                {!! link_to_route(config('quickadmin.route').'.radninalog.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.radninalog.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <script> addMarkerToArray({lng:{{$row->manholes->longitude}}, lat: {{$row->manholes->latitude}}});</script>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                    {!! link_to_route(config('quickadmin.route').'.radninalog.create', trans('quickadmin::templates.templates-view_index-view_checked') , null, array('class' => 'btn btn-primary')) !!}
                </div>

            </div>
            {!! Form::open(['route' => config('quickadmin.route').'.radninalog.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
	</div>
    <div id="map" class="portlet box green col-md-6" >
    </div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop