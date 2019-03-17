@extends('dashboard')

@section('content')

<section class="content-header">
      <h1>
        Tambahkan Data Baru
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Simple</li>
      </ol>
    </section>

    <br>
    <br>


<form action="{{ route('kategori.store') }}" method="post">
    {{csrf_field()}}
    <div class="form-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
        <label for="category_name" class="control-label">Nama Kategori</label>
        <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori">
        @if ($errors->has('category_name'))
            <span class="help-block">{{ $errors->first('category_name') }}</span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
        <label for="remarks" class="control-label">Deskripsi</label>
        <textarea name="remarks" cols="30" rows="5" class="form-control" placeholder="Deskripsi"></textarea>
        @if ($errors->has('remarks'))
            <span class="help-block">{{ $errors->first('remarks') }}</span>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>
@endsection