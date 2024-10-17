<?php

use App\Models\Juguete;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('formulario');
});

Route::post('/filtrar', function (Request $request) {
    $nombre = $request->input('nombre');
    $correo = $request->input('correo');
    $genero = $request->input('genero');

    $juguetes = Juguete::where('categoria', $genero)->get();

    return view('juguetes', compact('nombre', 'juguetes', 'correo'));
});

Route::post('/enviar-recomendacion', function (Request $request) {
    $correo = $request->input('correo');
    $juguetes_ids = $request->input('juguetes');

    if (empty($juguetes_ids)) {
        return back()->with('error', 'Por favor selecciona al menos un juguete.');
    }

    $juguetes = Juguete::whereIn('id', $juguetes_ids)->get(['nombre', 'precio', 'imagen']);

    $contenidoCorreo = "<h1>Estos son los juguetes recomendados:</h1><ul>";
    foreach ($juguetes as $juguete) {
        $contenidoCorreo .= "<li>";
        $contenidoCorreo .= "<strong>" . $juguete->nombre . " - $" . number_format($juguete->precio, 2) . "</strong><br>";

            $imagenUrl = url('images/' . $juguete->imagen);
       $contenidoCorreo .= "<img src='" . $imagenUrl . "' alt='" . $juguete->nombre . "' style='width:100px;height:100px;'><br>";
        $contenidoCorreo .= "</li>";
    }
    $contenidoCorreo .= "</ul>";

    Mail::send([], [], function ($message) use ($correo, $contenidoCorreo) {
        $message->to($correo)
                ->subject('Recomendación de Juguetes')
                ->html($contenidoCorreo);
    });

    return redirect('/')->with('success', '¡Revisa tu correo electrónico para ver las recomendaciones!');
});
