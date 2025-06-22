<!DOCTYPE html>
<html lang="id">
<head>
    <title>Selamat Datang - Reseporia</title>
</head>
<body>
    <h1>Selamat Datang!, {{ auth()->user()->name }}!</h1>
    <hr style="margin: 20px 0;">

    {{-- Form untuk logout --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
