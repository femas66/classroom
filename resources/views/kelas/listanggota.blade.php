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
  @if ($role == 'guru')
  <ul>
    @foreach ($lists as $anggota)
      @if ($anggota->user->id == Auth::user()->id)
        <li>{{ $anggota->user->name }} | {{ $anggota->role }}</li>
      @else  
        <li>{{ $anggota->user->name }} | {{ $anggota->role }} | <a href="{{ route('user.kick', ['user_id' => $anggota->user->id]) }}">Kick</a></li>
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