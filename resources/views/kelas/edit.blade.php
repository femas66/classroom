<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Buat kelas</title>
</head>
<body>
  <form action="{{ route('kelas.update') }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $kelas->id }}">
    <input type="text" name="nama_kelas" placeholder="Nama kelas" value="{{ $kelas->nama_kelas }}">
    <input type="text" name="mata_pelajaran" placeholder="Mata pelajaran" value="{{ $kelas->mata_pelajaran }}">
    <button type="submit">Edit</button>
  </form>
</body>
</html>