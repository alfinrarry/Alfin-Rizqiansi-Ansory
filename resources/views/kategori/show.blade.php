@extends('dashboard')

@section('content')
<h4>{{ $kategoris->category_name }}</h4>
<p>{{ $kategoris->remarks }}</p>
<a href="{{ route('kategori.index') }}" class="btn btn-default">Kembali</a>
@endsection