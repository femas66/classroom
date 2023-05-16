<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
</head>
<body>
  <h2>Register</h2>
  <hr>
  <form action="{{ route('register.post') }}" method="post">
    @csrf
    @method('POST')
    <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
    @error('name')
      {{ $message }}
    @enderror
    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
    @error('email')
      {{ $message }}
    @enderror
    <input type="password" name="password" id="password" placeholder="*****">
    @error('password')
      {{ $message }}
    @enderror
    <button type="submit">Register</button>
  </form>
</body>
</html>