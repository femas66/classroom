<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Materi</title>
</head>
<body>
  <h3>{{ $materi->judul_materi }}</h3>
  <small>{{ $materi->created_at }}</small>
  <hr>
  <p>{{ $materi->deskripsi_materi }}</p>
  <h4>Lampiran</h4>
  <br>
  <a href="/lampiran/{{ $materi->lampiran_materi }}" download>{{ $materi->lampiran_materi }}</a>
  <hr>
  <form action="{{ route('komentar.post') }}" method="post">
    @csrf
    <input type="hidden" name="materi_id" value="{{ $materi->id }}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="text" name="komentar" id="" placeholder="Komentar">
    <button type="submit">Kirim</button>
  </form>
  <h4>Komentar : </h4>
  <ul>
    @foreach ($materiKomentar as $komentar)
      <li>{{ $komentar->user->name }} : {{ $komentar->komentar }}
        @if ($komentar->user_id == Auth::user()->id || $role == 'guru')
        <form action="" method="post">
          @csrf
          @method('DELETE')
          <button type="submit">Hapus</button>
        </form>
        @endif
      </li>
    @endforeach
  </ul>
</body>
</html>