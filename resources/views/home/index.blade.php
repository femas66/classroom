<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
</head>
<body>
  <h2>Halo {{ Auth::user()->id }}</h2>
  <hr>
  @if ($error = session()->get('error'))
      {{ $error }}
  @endif
  @if ($success = session()->get('success'))
      {{ $success }}
  @endif
  <form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
  </form>
  <a href="{{ route('kelas.create') }}">Buat kelas</a>
  <a href="{{ route('kelas.gabung.index') }}">Gabung kelas</a>
  <hr>
  <ul>
    @foreach ($kelaslists as $item)
      <li><a href="{{ route('kelas.show', ['id' => $item->kelas->id]) }}">{{ $item->kelas->nama_kelas }}</a></li>
    @endforeach
  </ul>
</body>
</html>