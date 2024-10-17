<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomendación de Juguetes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
            text-align: left;
        }
        li {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        .juguete-info {
            display: flex;
            align-items: center;
        }
        .juguete-info i {
            margin-right: 10px;
            color: #ffbb33;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Hola {{ $nombre }}, selecciona tus juguetes recomendados:</h1>
        <form action="/enviar-recomendacion" method="POST">
            @csrf
            <input type="hidden" name="correo" value="{{ $correo }}">
            <ul>
                @foreach ($juguetes as $juguete)
                    <li>
                        <div class="juguete-info">
                            <i class="fas fa-cube"></i>
                            <span>{{ $juguete->nombre }} - ${{ number_format($juguete->precio, 2) }}</span>
                        </div>
                        <input type="checkbox" name="juguetes[]" value="{{ $juguete->id }}">
                    </li>
                @endforeach
            </ul>
            <button type="submit">Enviar recomendación por correo</button>
        </form>
    </div>
</body>
</html>
