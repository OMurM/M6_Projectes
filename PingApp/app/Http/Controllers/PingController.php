<?php
// App/Http/Controllers/PingController.php
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

        // Perform the ping and store the result
        $this->performPing($request->ip_dominio, $request->nombre);

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
            // Ping the domain and measure the status and latency
            $pingResult = $this->ping($ping->ip_dominio);
            $ping->estado = $pingResult['status'];  // true for online, false for offline
            $ping->latency = $pingResult['latency'];  // store the latency (in ms)

            $ping->save();

            $updatedPings[] = [
                'ip_dominio' => $ping->ip_dominio,
                'estado' => $ping->estado ? 'Online' : 'Offline',
                'latency' => $ping->latency,
            ];
        }

        return response()->json($updatedPings);
    }

    // Perform the ping and save the data
    private function performPing($ip, $nombre)
    {
            
        $ping = Ping::where('ip_dominio', $ip)->first();

        $startTime = microtime(true);
        $command = sprintf("ping -n 1 %s", escapeshellarg($ip));
        $output = shell_exec($command);
        $endTime = microtime(true);

        $latency = ($endTime - $startTime) * 1000; // Convert to milliseconds

        if ($ping) {
            // If it exists, update the existing record
            $ping->nombre = $nombre;
            $ping->estado = strpos($output, 'TTL') !== false; // Check if the ping was successful
            $ping->latency = $latency;
            $ping->save();
        } else {
            // If it doesn't exist, create a new record
            $ping = new Ping();
            $ping->ip_dominio = $ip;
            $ping->nombre = $nombre;
            $ping->estado = strpos($output, 'TTL') !== false; // Check if the ping was successful
            $ping->latency = $latency; // Save latency in milliseconds
            $ping->save();
        }
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

        // Perform the ping and get the status and latency
        $pingResult = $this->ping($ping->ip_dominio);

        // Check if the ping result is valid
        if (!is_array($pingResult) || !isset($pingResult['status'], $pingResult['latency'])) {
            return response()->json(['error' => 'Error performing ping.'], 500);
        }

        // Update the ping record
        $ping->estado = $pingResult['status'];
        $ping->latency = $pingResult['latency'];
        $ping->save();

        return response()->json([
            'status' => $pingResult['status'],
            'latency' => $pingResult['latency'],
        ]);
    }


    // Update ping method to return an array
    private function ping($ip)
    {
        $startTime = microtime(true);
        $command = sprintf("ping -n 1 %s", escapeshellarg($ip));
        $output = shell_exec($command);
        $endTime = microtime(true);

        $latency = round(($endTime - $startTime) * 1000, 2);

        return [
            'status' => strpos($output, 'TTL') !== false,
            'latency' => $latency,
        ];
    }
}
