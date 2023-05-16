<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Buat kelas</title>
</head>
<body>
  <form action="{{ route('kelas.store') }}" method="POST">
    @csrf
    <input type="text" name="nama_kelas" placeholder="Nama kelas">
    <input type="text" name="mata_pelajaran" placeholder="Mata pelajaran">
    <button type="submit">Buat</button>
  </form>
</body>
</html>