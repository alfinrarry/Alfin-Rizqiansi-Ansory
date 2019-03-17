@extends('dashboard')

@section('content')
<h4>Ubah Data</h4>
<form action="{{ route('kategori.edit', $data_kategori->category_id) }}" method="post">
    
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
        <label for="category_id" class="control-label">ID Kategori</label>
        <input type="text" class="form-control" name="category_id"  value={{ $data_kategori->category_id}}">
        @if ($errors->has('category_id'))
            <span class="help-block">{{ $errors->first('category_id') }}</span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
        <label for="category_name" class="control-label">Nama Kategori</label>
        <input type="text" class="form-control" name="category_name"  value={{ $data_kategori->category_name}}">
        @if ($errors->has('category_name'))
            <span class="help-block">{{ $errors->first('category_name') }}</span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
        <label for="remarks" class="control-label">Deskripsi</label>
        <textarea name="remarks" cols="30" rows="5" class="form-control" value={{ $data_kategori->remarks }}></textarea>
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