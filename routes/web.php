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

    $juguetes = Juguete::whereIn('id', $juguetes_ids)->get(['nombre', 'precio']);

    $contenidoCorreo = "Estos son los juguetes recomendados:\n\n";
    foreach ($juguetes as $juguete) {
        $contenidoCorreo .= $juguete->nombre . " - $" . number_format($juguete->precio, 2) . "\n";
    }

    Mail::raw($contenidoCorreo, function($message) use ($correo) {
        $message->to($correo)
                ->subject('Recomendación de Juguetes');
    });

    return redirect('/')->with('success', '¡Revisa tu correo electrónico para ver las recomendaciones!');
});
