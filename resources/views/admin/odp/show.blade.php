@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.odp.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>ODP</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item"><a href="#">ODP</a></div>
                    <div class="breadcrumb-item"><a href="#">Survey Jalur</a></div>
                </div>
            </div>
            <section id="multiple-column-form">
                <h2 class="section-title">Survey Jalur</h2>
                <div class="row match-height">
                    <div class="col-md-12 ">
                        <div class="card">

                            <div style="z-index: 0" class="w-full h-96 relative flex bg-gray-600" id="mapid"></div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('admin.odp.show', $odp->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Nama olt</label>
                                                </div>
                                                <div class="col-md-8 form-group">

                                                    <input type="text" id="nama" class="form-control" name="nama"
                                                        value=" {{ $odp->olt->nama }}" readonly>

                                                </div>

                                                <div class="col-md-4">
                                                    <label>Nama odp</label>
                                                </div>
                                                <div class="col-md-8 form-group">

                                                    <input type="text" id="nama" class="form-control" name="nama"
                                                        value=" {{ $odp->nama }}" readonly>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Alamat</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="alamat" class="form-control" name="alamat"
                                                        value="{{ $odp->alamat }}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Jumlah Port</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="port" class="form-control" name="port"
                                                        value="{{ $odp->port }}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Port Terpakai</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="terpakai" class="form-control" name="terpakai"
                                                        value="{{ $odp->terpakai }}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Port Kosong</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="total" class="form-control" name="total"
                                                        value="{{ $odp->total }}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Latitude</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="latitude" class="form-control" name="latitude"
                                                        value="{{ $odp->latitude }}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Longitude</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="longitude" class="form-control"
                                                        name="longitude" value="{{ $odp->longitude }}" readonly>
                                                </div>


                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
        </section>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        #mapid {
            min-height: 600px;
        }

    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />


    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    {{-- <style>
    .leaflet-top {
        display: none;
    }

</style> --}}
@endpush
@push('script')
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>

    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script>
        var map = L.map('mapid').setView([-7.563828, 110.8173266], 6);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'sk.eyJ1IjoibWFyaWZmaW4iLCJhIjoiY2tqM3V3OHByMGY4ejJybnE0ZDZpN2JpdSJ9.VkZp3cjQSPoL7lpc-VWsCg'
        }).addTo(map);



        // setInterval(() => {
        //     map.locate({
        //         setView: true,
        //         maxZoom: 16
        //     });

        // }, 3000);

        map.locate({
            setView: true,
            maxZoom: 16
        });


        function onLocationFound(e) {
            var radius = e.accuracy;

            L.marker(e.latlng).addTo(map)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();

            L.circle(e.latlng, radius).addTo(map);
            L.Routing.control({
                waypoints: [
                    L.latLng(e.latlng),
                    L.latLng({{ $odp->latitude }}, {{ $odp->longitude }})
                ]
            }).addTo(map);
        }

        map.on('locationfound', onLocationFound);

        // lc = L.control.locate({
        //     strings: {
        //         title: "Show me where I am, yo!"
        //     }
        // }).addTo(map);
    </script>
@endpush
