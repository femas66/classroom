<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="{{ route('materi.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="kelas_id" value="{{ $kelas_id }}" value="{{ old('kelas_id') }}">
    <input type="text" name="judul_materi" id="" placeholder="judul materi" value="{{ old('judul_materi') }}">
    <textarea name="deskripsi_materi" id="" cols="30" rows="10">{{ old('deskripi_materi') }}</textarea>
    <input type="file" name="lampiran_materi" id="">
    <button type="submit">Posting</button>
  </form>
</body>
</html>