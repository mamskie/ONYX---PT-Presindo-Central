@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Tambah Arsip</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Arsip</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Arsip</li>
                </ol>
            </nav>
        </div>

        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Arsip</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample" method="POST" action="/save-sm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail3">Nomor Arsip</label>
                            <input type="text" name="nomor" class="form-control" id="exampleInputEmail3"
                                placeholder="Nomor Surat" value="{{ old('nomor') }}">
                            @error('nomor')
                                <p class="text-danger pt-1"><small> {{ $message }}</small></p>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputPassword4">Tanggal Arsip</label>
                            <input type="date" name="tglMasuk" class="form-control" id="exampleInputPassword4"
                                placeholder="Tanggal Surat" value="{{ old('tglMasuk') }}">
                            @error('tglMasuk')
                                <p class="text-danger pt-1"><small> {{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Nama</label>
                            <input type="text" name="nama" class="form-control" id="exampleInputCity1"
                                placeholder="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <p class="text-danger pt-1"><small> {{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Kategori</label>
                            <select class="form-control" id="exampleFormControlSelect2" name="kategori_id"
                                value="{{ old('kategori_id') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($data as $x)
                                    <option value="{{ $x->id }}">{{ $x->keterangan }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="text-danger pt-1"><small> {{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="file" class="file-upload-default" value="{{ old('file') }}">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload File">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary"
                                        type="button">Upload</button>
                                </span>
                            </div>
                            @error('file')
                                <p class="text-danger pt-1"><small> {{ $message }}</small></p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Tambah Arsip</button>
                        <a href="view-sm" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
