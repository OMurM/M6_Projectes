<?php
// App/Http/Controllers/PingController.php

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
        'ip_dominio' => ['required', 'string', 'max:255', function($attribute, $value, $fail) {
            if (!filter_var($value, FILTER_VALIDATE_IP) && !filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
                $fail('The ' . $attribute . ' must be a valid IP address or domain.');
            }
        }],
        'nombre' => 'required|string|max:255',
    ]);

    Ping::create([
        'ip_dominio' => $request->ip_dominio,
        'nombre' => $request->nombre,
        'estado' => false,
    ]);

    return redirect()->route('pings.index')->with('success', 'Ping created successfully!');
    }

    public function destroy($id)
    {
        $ping = Ping::find($id);

        if (!$ping) {
            return redirect()->route('pings.index')->with('error', 'Ping not found.');
        }

        $ping->delete();

        return redirect()->route('pings.index')->with('success', 'Ping deleted successfully!');
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

    private function ping($ip_or_domain)
    {
    $output = [];
    $status = null;

    if (filter_var($ip_or_domain, FILTER_VALIDATE_IP)) {
        $command = sprintf("ping -n 1 %s", escapeshellarg($ip_or_domain));
    } else {
        $command = sprintf("ping -n 1 %s", escapeshellarg(gethostbyname($ip_or_domain)));
    }

    exec($command, $output, $status);

    return $status === 0;
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'ip_dominio' => 'required|ip|max:15',
        'nombre' => 'required|string|max:255',
    ]);

    $ping = Ping::find($id);

    if (!$ping) {
        return response()->json(['error' => 'Ping not found'], 404);
    }

    $ping->update([
        'ip_dominio' => $request->ip_dominio,
        'nombre' => $request->nombre,
    ]);

    return response()->json(['success' => 'Ping updated successfully!']);
    }

    public function checkStatus($id)
    {
    
        $ping = Ping::findOrFail($id);
    
    $pingStatus = $this->ping($ping->ip_dominio);
    
    $ping->estado = $pingStatus;
    $ping->save();

    return response()->json([
        'status' => $pingStatus
    ]);

    }
}
