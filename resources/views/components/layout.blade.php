@props([
    'title' => 'My Laravel App',
])
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head> 
<style>
    body{
        background-color: #1c3056;
        color: white;
        font-family: Arial, sans-serif;
    }
    nav{
        background-color: rgb(252, 248, 242);
        padding: 10px;
        color: #000000;
        font-weight: bold;
    }
    nav a{
        padding: 10px;
        text-decoration: none;
        color: #000;
        transition: color 0.3s;
    }
    nav a:hover{
        color: #4f46e5; /* nice hover effect */
    }
</style>
<body>
    <nav>
        <a href="/">Home</a> | 
        <a href="/about">About</a> |
        <a href="/contact">Contact</a> |
        <a href="/formtest">Form Test</a> |
        <a href="/posts">Posts</a> |
        <a href="{{ route('users.index') }}">User Registration</a>
    </nav>

    {{ $slot }}

</body>
</html>