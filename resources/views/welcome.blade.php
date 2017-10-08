@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="url" value="{{ url('home') }}">
                <div class="panel panel-default">
                    <div class="panel-heading">chart</div>

                    <div class="panel-body">
                        <div id="container1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="{{ asset('js/charts.js') }}"></script>

@endsection
