@extends('layouts.dashboard2')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>ODC</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">User</a></div>
                    <div class="breadcrumb-item"><a href="#">ODC</a></div>

                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data ODC</h2>

                <div class="row">
                    <div class="col-12">
                        <div class="card">



                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="w-full h-96 relative flex bg-gray-400" id="mapid"></div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                NO
                                                            </th>
                                                            <th>Nama OLT</th>
                                                            <th>Nama ODC</th>
                                                            <th>Alamat</th>

                                                            <th>Latitude</th>
                                                            <th>Longitude</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($odc as $index => $odc)
                                                            <tr>
                                                                <td>
                                                                    {{ $index + 1 }}

                                                                </td>
                                                                <td>{{ $odc->olt->nama }}</td>
                                                                <td>{{ $odc->nama }}</td>
                                                                <td>{{ $odc->alamat }}</td>

                                                                <td>{{ $odc->latitude }}</td>
                                                                <td>{{ $odc->longitude }}</td>
                                                                <td>

                                                                    <a href="{{ route('user.odc.show', $odc->id) }}"
                                                                        class="btn btn-info">Survey</a>



                                                                </td>
                                                            </tr>
                                                            <input type="hidden" value="{{ $odc->id }}"
                                                                id="id{{ $loop->index }}">
                                                            <input type="hidden" value="{{ $odc->nama }}"
                                                                id="nama{{ $loop->index }}">
                                                            <input type="hidden" value="{{ $odc->alamat }}"
                                                                id="alamat{{ $loop->index }}">
                                                            <input type="hidden" value="{{ $odc->latitude }}"
                                                                id="lat{{ $loop->index }}">
                                                            <input type="hidden" value="{{ $odc->longitude }}"
                                                                id="lon{{ $loop->index }}">
                                                            @php
                                                                $a = '';
                                                                $a = $loop->index;
                                                            @endphp
                                                        @endforeach


                                                        <input type="hidden" value="{{ $a ?? '' }}" id="index">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
@endpush

@push('script')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>


    <script>
        var mymap = L.map('mapid').setView([-7.563828, 110.8173266], 8);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'sk.eyJ1IjoibWFyaWZmaW4iLCJhIjoiY2tqM3V3OHByMGY4ejJybnE0ZDZpN2JpdSJ9.VkZp3cjQSPoL7lpc-VWsCg'
        }).addTo(mymap);
        var a = []
        var longlat = [];
        var label = [];
        var marker = [];
        var index = document.getElementById('index').value;
        if (index == '') {
            var a = 1;
        } else {
            // Coordinate
            for (c = 0; c <= index; c++) {
                var lat = parseFloat(document.getElementById('lat' + [c]).value);
                var lon = parseFloat(document.getElementById('lon' + [c]).value);
                var arr = [lat, lon];
                longlat.push(arr);

            }
            // LabelPopup

            for (d = 0; d <= index; d++) {
                var nama = document.getElementById('nama' + [d]).value;
                var alamat = document.getElementById('alamat' + [d]).value;
                var arr = [nama, alamat];
                label.push(arr);
            }
            for (i = 0; i < longlat.length; i++) {
                var push = L.marker(longlat[i]).addTo(mymap)
                marker.push(push);

            }

            for (a = 0; a < label.length; a++) {
                marker[a].bindPopup("Nama ODC = " + label[a][0] + "<br>" + "Alamat = " + label[a][1]);
            }
        }


        // var marker = L.marker([-7.514980942395872, 110.93994140625001]).addTo(mymap);
        lc = L.control.locate({
            strings: {
                title: "Lokasi Mu Saat ini!!"
            }
        }).addTo(mymap);
    </script>
    <script>

    </script>
@endpush
