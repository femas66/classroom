<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>List anggota</title>
</head>
<body>
  <h1>List anggota</h1>
  <hr>
  <form method="POST" action="{{ route('kelas.keluar') }}">
    @csrf
    <input type="hidden" name="kelas_id" value="{{ $id }}">
    <button type="submit" onclick="return confirm('Yakin mau keluar')">Keluar</button>
  </form>
  @if ($role == 'guru')
  <ul>
    @foreach ($lists as $anggota)
      @if ($anggota->user->id == Auth::user()->id)
        <li>{{ $anggota->user->name }} | {{ $anggota->role }}</li>
        <hr>
      @else  
        @if ($anggota->role == 'member')
          <li>{{ $anggota->user->name }} | {{ $anggota->role }} | <form action="{{ route('user.guru') }}" method="post">@csrf<input type="hidden" name="user_id" value="{{ $anggota->user_id }}"><input type="hidden" name="kelas_id" value="{{ $id }}"><button type="submit">Jadikan guru</button></form> | <a href="{{ route('user.kick', ['user_id' => $anggota->user->id]) }}">Kick</a></li>
          <hr>
        @else
          <li>{{ $anggota->user->name }} | {{ $anggota->role }} |  <form action="{{ route('user.member') }}" method="post">@csrf<input type="hidden" name="user_id" value="{{ $anggota->user_id }}"><input type="hidden" name="kelas_id" value="{{ $id }}"><button type="submit">Jadikan member</button></form> |<a href="{{ route('user.kick', ['user_id' => $anggota->user->id]) }}">Kick</a></li>
          <hr>
        @endif
      @endif
    @endforeach
  </ul>
  @else
    <ul>
      @foreach ($lists as $anggota)
        <li>{{ $anggota->user->name }} | {{ $anggota->role }} </li>
      @endforeach
    </ul>
  @endif
  
</body>
</html>