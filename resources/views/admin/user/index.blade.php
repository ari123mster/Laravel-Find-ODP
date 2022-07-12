@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>user</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item"><a href="#">user</a></div>

                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data user</h2>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('admin.user.create') }}">
                                    <button class="btn btn-primary">Tambah</button>
                                </form>
                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                NO
                                                            </th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            {{-- <th>Roles</th> --}}
                                                            <th>Password</th>


                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($user as $index => $user)
                                                            <tr>
                                                                <td>
                                                                    {{ $index + 1 }}

                                                                </td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                {{-- <td>{{ $user->role }}</td> --}}
                                                                <td>{{ $user->password }}</td>


                                                                <td>
                                                                    <form
                                                                        action="{{ route('admin.user.destroy', $user->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger d-inline">
                                                                            hapus
                                                                        </button>

                                                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                                                            class="btn btn-warning ">Edit</a>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
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
