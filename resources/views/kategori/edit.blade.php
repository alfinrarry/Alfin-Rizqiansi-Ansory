@extends('dashboard')

@section('content')
<h4>Ubah Data</h4>
@foreach($kategoris as $data_kategori)
<form action="{{route('kategori.update',$data_kategori->category_id)}}" method="post">
@method('PATCH')
{{ csrf_field() }}
<input type="hidden" name="category_id" value="{{ $data_kategori->category_id }}"> <br/>

    <div class="form-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
        <label for="category_name" class="control-label">Nama Kategori</label>
        <input type="text" class="form-control" name="category_name"  value="{{ $data_kategori->category_name}}">
        @if ($errors->has('category_name'))
            <span class="help-block">{{ $errors->first('category_name') }}</span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
        <label for="remarks" class="control-label">Deskripsi</label>
        <input type="text" class="form-control" name="remarks"  value="{{ $data_kategori->remarks}}">
        @if ($errors->has('remarks'))
            <span class="help-block">{{ $errors->first('remarks') }}</span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('tglInput') ? 'has-error' : '' }}">
        <label for="tglInput" class="control-label">Tanggal Input</label>
        <input type="date" class="form-control" name="tglInput"  value="{{$data_kategori->tglInput}}">
        @if ($errors->has('tglInput'))
            <span class="help-block">{{ $errors->first('tglInput') }}</span>
        @endif
    </div>
    


    <div class="form-group">
        <input type="submit" class="btn btn-info" value="Simpan Data">
        <a href="{{ route('kategori.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>
@endforeach
@endsection