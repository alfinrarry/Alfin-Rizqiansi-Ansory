<html>
<head> 
<title> Tabel Film </title>
</head>
<body>
<center>
<table border=1 style="border-collapse:collapse;padding:4px">
<caption><b>Daftar Film</b></caption> 
<tr><th>Nama Kategori</th><th>Deskripsi</th><th>Waktu Posting</th></tr>
@foreach($kategoris as $data_kategori)
<tr>
<td>{{$data_kategori->nama_kategori}} </td>
<td>{{$data_kategori->deskripsi}}</td>
<td>{{$data_kategori->waktu_posting}}</td>
@endforeach
</tr>
</table></center>

</body>
</html>
