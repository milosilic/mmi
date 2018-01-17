@extends('admin.layouts.master')

@section('content')
    <script>
        function initMap() {
            var uluru = {lat: {{ $radninalog->manholes->latitude or '' }}, lng: {{ $radninalog->manholes->longitude or '' }}};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <div class="panel panel-default">
        <div class="panel-heading">
            View
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>Project</th>
                    <td>{{ $radninalog->manholes->name or '' }}</td></tr><tr><th>Transaction type</th>
                    <td>{{ $radninalog->transaction_type->title or '' }}</td></tr><tr><th>Income source</th>
                    <td>{{ $radninalog->income_sousetrce->title or '' }}</td></tr><tr><th>Title</th>
                    <td>{{ $radninalog->title }}</td></tr><tr><th>Description</th>
                    <td>{!! $radninalog->description !!}</td></tr><tr><th>Amount</th>
                    <td>{{ $radninalog->amount }}</td></tr><tr><th>Currency</th>
                    <td>{{ $radninalog->currency->title or '' }}</td></tr><tr><th>Transaction date</th>
                    <td>{{ $radninalog->transaction_date }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6" id="map" style="height: 300px"></div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.radninalog.index') }}" class="btn btn-default">Back to list</a>
        </div>
    </div>
@stop