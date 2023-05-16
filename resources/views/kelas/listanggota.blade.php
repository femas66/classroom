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
  <ul>
    @foreach ($lists as $anggota)
      <li>{{ $anggota->user->name }} | {{ $anggota->role }}</li>
    @endforeach
  </ul>
</body>
</html>