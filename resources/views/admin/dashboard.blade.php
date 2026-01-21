@extends('admin.admin')

@section('content')
<div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>

        {{-- Card Statistik --}}
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Total Views</div>
                    {{-- <div class="card-footer">{{ $totalViews }}</div> --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Unique Visitors</div>
                    {{-- <div class="card-footer">{{ $uniqueVisitors }}</div> --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Bounce Rate</div>
                    {{-- <div class="card-footer">{{ $bounceRate }}%</div> --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Avg. Time on Site</div>
                    {{-- <div class="card-footer">{{ $avgTime }} sec</div> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                {{-- Pie chart --}}
                <div class="card mb-4">
                    <div class="card-header">Tipe Perangkat</div>
                    <div class="card-body">
                        <canvas id="deviceChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-8"> {{-- Grafik Line Chart --}}
                <div class="card mb-4">
                    <div class="card-header">Views Per Hari (7 Hari Terakhir)</div>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            {{-- Grafik Bar Chart --}}
            <div class="card mb-8">
                <div class="card-header">5 Halaman Teratas</div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
</div>
@endsection