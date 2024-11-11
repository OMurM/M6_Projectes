<?php

namespace App\Http\Controllers;

use App\Models\Ping;
use Illuminate\Http\Request;

class PingController extends Controller
{
    // Mostrar todos los pings
    public function index()
    {
        $pings = Ping::all(); // Obtener todos los pings
        return view('pings.index', compact('pings')); // Retornar la vista con los pings
    }

    // Mostrar el formulario para crear un nuevo ping
    public function create()
    {
        return view('pings.create'); // Retornar la vista de creación
    }

    // Almacenar un nuevo ping
    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'ip_dominio' => 'required|ip|max:15', // Validar IP/Dominio
            'nombre' => 'required|string|max:255', // Validar nombre
        ]);

        // Crear un nuevo registro de ping en la base de datos
        Ping::create([
            'ip_dominio' => $request->ip_dominio,
            'nombre' => $request->nombre,
            'estado' => false, // Inicializar el estado como false
        ]);

        // Redirigir a la lista de pings con un mensaje de éxito
        return redirect()->route('allpings')->with('success', 'Ping creado con éxito!'); 
    }

    // Validar el estado de los pings
    public function validate_ping()
    {
        // Obtener todos los pings de la base de datos
        $pings = Ping::all();
        $updatedPings = [];

        foreach ($pings as $ping) {
            // Llamar a la función de ping y verificar el estado
            $pingStatus = $this->ping($ping->ip_dominio);

            // Actualizar el estado en la base de datos
            $ping->estado = $pingStatus;
            $ping->save();

            // Añadir el ping actualizado al array
            $updatedPings[] = [
                'ip_dominio' => $ping->ip_dominio,
                'estado' => $ping->estado ? 'Online' : 'Offline',
            ];
        }

        // Retornar la respuesta JSON con los estados actualizados
        return response()->json($updatedPings);
    }

    private function ping($ip)
    {
        $output = [];
        $status = null;

        // Para Windows: "ping -n 1"
        // Para Linux/Mac: "ping -c 1"
        $command = sprintf("ping -n 1 %s", escapeshellarg($ip));

        exec($command, $output, $status);

        return $status === 0; 
    }
}
