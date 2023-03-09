@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Edit Kategori</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Kategori</li>
                </ol>
            </nav>
        </div>

        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Kategori</h4>
                    <p class="card-description"></p>
                    <form action="/update-jenis/{{ $data->id }}" method="POST" class="forms-sample"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="exampleInputName1"
                                placeholder="Id Jenis" value="{{ $data->id }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Kode Arsip</label>
                            <input type="text" name="kategori" class="form-control" id="exampleInputEmail3"
                                placeholder="Kode Arsip" value="{{ $data->kategori }}">
                            @error('kategori')
                                <p class="text-danger pt-1"><small> {{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" id="exampleInputPassword4"
                                placeholder="Keterangan" value="{{ $data->keterangan }}">
                            @error('keterangan')
                                <p class="text-danger pt-1"><small> {{ $message }}</small></p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Edit Arsip</button>
                        <a href="/view-jenis" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
