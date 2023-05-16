<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <hr>
  <form action="{{ route('login.post') }}" method="post">
    @csrf
    @method('POST')
    <input type="email" name="email" id="email" placeholder="Email">
    <input type="password" name="password" id="password" placeholder="*****">
    <button type="submit">Login</button>
  </form>
</body>
</html>