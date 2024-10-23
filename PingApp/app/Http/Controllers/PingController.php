<?php

namespace App\Http\Controllers;

use App\Models\Ping;
use Illuminate\Http\Request;

class PingController extends Controller
{
    public function index()
    {
        $pings = Ping::all();
        return view('pings.index', compact('pings'));
    }

    public function create()
    {
        return view('pings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip_dominio' => 'required|ip|max:15',
            'nombre' => 'required|string|max:255',
        ]);

        Ping::create([
            'ip_dominio' => $request->ip_dominio,
            'nombre' => $request->nombre,
            'estado' => false,
        ]);

        return redirect()->route('pings.index')->with('success', 'Ping creado con éxito!');
    }

    public function validate_ping()
    {
        $pings = Ping::all();
        $updatedPings = [];

        foreach ($pings as $ping) {

            $pingStatus = $this->ping($ping->ip_dominio);
            $ping->estado = $pingStatus;
            $ping->save();

            $updatedPings[] = [
                'ip_dominio' => $ping->ip_dominio,
                'estado' => $ping->estado ? 'Online' : 'Offline',
            ];
        }

        return response()->json($updatedPings);
    }

    private function ping($ip)
    {
        $output = [];
        $status = null;

        // Comando de ping
        $command = sprintf("ping -n 1 %s", escapeshellarg($ip));
        exec($command, $output, $status);

        return $status === 0;
    }
}
