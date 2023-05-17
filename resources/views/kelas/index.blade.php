<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kelas</title>
</head>
<body>
  <h1>Selamat datang di kelas : {{ $info_kelas->nama_kelas }} | {{ $info_kelas->kode_kelas }}</h1>
  @if ($role->role == 'guru')
    <a href="{{ route('kelas.edit', ['id' => $info_kelas->id]) }}">Edit</a>
    <form action="{{ route('kelas.hapus', ['id' => $info_kelas->id]) }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit">Hapus</button>
    </form>
    <p>Link gabung : {{ $domain }}</p>
  @endif
  <h4>Role : {{ $role->role }}</h4>

  <a href="{{ route('kelas.list.anggota', ['id' => $info_kelas->id]) }}">List anggota</a>
  @if ($role->role == 'guru')
    <a href="{{ route('materi.create', ['id' => $info_kelas->id, 'user_id' => Auth::user()->id]) }}">Buat materi</a>
    <a href="">Buat tugas</a>
  @endif
  <br>
  <h4>Materi</h4>
  <hr>
  @if (count($materis) > 0)
  <ul>
    @foreach ($materis as $materi)
    <li><a href="{{ route('materi.show', ['id' => $materi->id, 'kelas_id' => $info_kelas->id]) }}">{{ $materi->judul_materi }}</a> 
      @if($role->role == 'guru')
        <form action="{{ route('materi.delete', ['id' => $materi->id]) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
        </form>
      @endif
    </li>
    @endforeach
  </ul>
  @endif
</body>
</html>