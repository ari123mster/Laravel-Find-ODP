@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Graph</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item"><a href="#">Graph</a></div>
                    <div class="breadcrumb-item"><a href="#">ODP</a></div>

                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Graph ODP</h2>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div id="chart-container">
                                {!! $chart->container() !!}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    {!! $chart->script() !!}
@endpush
