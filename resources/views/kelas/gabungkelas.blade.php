<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gabung kelas</title>
</head>
<body>
  @if ($error = session()->get('error'))
    {{ $error }}
  @endif
  <form action="{{ route('kelas.gabung.store') }}" method="post">
    @csrf
    <input type="text" name="kode_kelas" id="kode_kelas" placeholder="Kode">
    @error('kode_kelas')
      <small>{{ $message }}</small>
    @enderror
    <hr>
    <button type="submit">Submit</button>
  </form>
</body>
</html>