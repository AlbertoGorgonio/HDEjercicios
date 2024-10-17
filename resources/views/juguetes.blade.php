<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomendación de Juguetes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Fondo con un degradado suave */
        body {
            background: linear-gradient(135deg, #f0f4ff, #dff0e7);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .result-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 1.8em;
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

        .juguete-info img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
            border-radius: 4px;
        }

        input[type="checkbox"] {
            margin-left: 10px;
            transform: scale(1.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #5cb85c;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 1.2em;
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
                            <img src="{{ asset('images/' . $juguete->imagen) }}" alt="{{ $juguete->nombre }}">
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
