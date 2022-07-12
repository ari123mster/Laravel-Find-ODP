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
                    <div class="breadcrumb-item"><a href="#">Edit Data</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Data ODP</h2>


                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-md-12 ">
                            <div class="card">

                                <div style="z-index: 0" class="w-full h-96 relative flex bg-gray-400" id="mapid"></div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('admin.odp.update', $odp->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Nama olt</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">

                                                        <select class="form-control" name="olt_id">
                                                            <option>..Pilih..</option>
                                                            @foreach ($olt as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if ($odp->olt_id == $item->id) selected @endif>
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Nama odp</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="nama" class="form-control" name="nama"
                                                            placeholder="" value="{{ $odp->nama }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Alamat</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="alamat" class="form-control" name="alamat"
                                                            placeholder="" value="{{ $odp->alamat }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Port Terpakai</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="port" class="form-control" name="port"
                                                            value="{{ $odp->port }}" onkeyup="sum();">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Port Terpakai</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="terpakai" class="form-control"
                                                            name="terpakai" value="{{ $odp->terpakai }}" onkeyup="sum();">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Port Kosong</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="total" class="form-control" name="total"
                                                            onkeyup="sum();" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Latitude</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="latitude" class="form-control"
                                                            name="latitude" placeholder="" value="{{ $odp->latitude }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Longitude</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="longitude" class="form-control"
                                                            name="longitude" placeholder="" value="{{ $odp->longitude }}">
                                                    </div>
                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                        <button type="submit"
                                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                                        <button type="reset"
                                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        @foreach ($odp as $odp)
                                            @php
                                                $a = '';
                                                $a = $loop->index;
                                            @endphp
                                        @endforeach
                                        <input type="hidden" value="{{ $a ?? '' }}" id="index">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            @endsection

            @push('style')
                <link rel="stylesheet" href="{{ asset('css/app.css') }}">
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
                    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
                    crossorigin="" />
            @endpush

            @push('script')
                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                                crossorigin=""></script>
                <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />

                <script>
                    var mymap = L.map('mapid').setView([-7.563828, 110.8173266], 6);
                    var popup = L.popup();
                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken: 'sk.eyJ1IjoibWFyaWZmaW4iLCJhIjoiY2tqM3V3OHByMGY4ejJybnE0ZDZpN2JpdSJ9.VkZp3cjQSPoL7lpc-VWsCg'
                    }).addTo(mymap);
                    // Coordinate
                    var lat = parseFloat(document.getElementById('latitude').value);
                    var lon = parseFloat(document.getElementById('longitude').value);
                    var nama = document.getElementById('nama').value;

                    // var label = document.getElementById('nama_wilayah').value;
                    var arr = [lat, lon];
                    var marker = L.marker(arr).addTo(mymap)
                    marker.bindPopup("<center>Ini lokasi lama</center>" + "<br>" + "nama = " + nama).openPopup();


                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent("<center>Ini lokasi baru yang anda pilih</center <br> Latitude = " + e.latlng.lat + "<br>" +
                                "Longitude = " + e.latlng.lng)
                            .openOn(mymap);
                        var a = e.latlng.toString();
                        var latitude = e.latlng.lat;
                        var longitude = e.latlng.lng;
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                    }


                    mymap.on('click', onMapClick);
                    lc = L.control.locate({
                        strings: {
                            title: "Lokasi Mu Saat ini!!"
                        }
                    }).addTo(mymap);
                </script>
                <script>
                    function sum() {
                        var txtFirstNumberValue = document.getElementById('port').value;
                        var txtSecondNumberValue = document.getElementById('terpakai').value;
                        var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
                        if (!isNaN(result)) {
                            document.getElementById('total').value = result;
                        }
                    }
                </script>
            @endpush
