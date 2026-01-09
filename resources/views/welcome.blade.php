<!DOCTYPE html>
<html>

    <style>


   .btn-home {
    display: inline-block;
    background-color: #3490dc;
    color: white;
    padding: 8px 15px;
    border-radius: 15px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-home:hover {
    background-color: #2779bd;
    transform: scale(1.05);
}

    </style>




<head>
    <title>Welcome Page</title>
</head>
<body>
    <h1>Welcome to Our Application!</h1>
    <p>This is the welcome page of our application.</p><br><br>

<a href="{{ route('auteurs.index') }}" class="btn-home"> Aller sur la page des auteurs -></a>

</body>
</html>
