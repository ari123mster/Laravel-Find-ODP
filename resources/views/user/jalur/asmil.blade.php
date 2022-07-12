@extends('layouts.dashboard2')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jalur Kabel</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">User</a></div>
                    <div class="breadcrumb-item"><a href="#">Jalur Kabel</a></div>
                    <div class="breadcrumb-item"><a href="#">Asmil 413</a></div>
                </div>
            </div>
            {{-- <div class="section-body">
                <h2 class="section-title">IN DEVELOPMENT</h2>
            </div> --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="section-title">Jalur Kabel Asmil 413</h2>
                        </div>

                        <div style="width: 77vw; height: 100vh" id="map"></div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
@endpush
@push('script')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


    <script src="{{ asset('assets/js/L.KML.js') }}"></script>
    <script type="text/javascript">
        // Make basemap
        var map = new L.Map('map', {
            center: new L.LatLng(-7.6283904, 110.8818373),
            zoom: 11
        });
        var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

        map.addLayer(osm);
    </script>
    <script>
        // Load kml file
        fetch('/assets/map/asmil.kml')
            .then(res => res.text())
            .then(kmltext => {
                // Create new kml overlay
                var parser = new DOMParser();
                var kml = parser.parseFromString(kmltext, 'text/xml');
                var track = new L.KML(kml);
                map.addLayer(track);

                // Adjust map to show the kml
                var bounds = track.getBounds();
                map.fitBounds(bounds);

            });
    </script>
@endpush
