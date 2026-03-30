<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StabilityService;
use Intervention\Image\Facades\Image; // 🔥 Importante
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StabilityController extends Controller
{
    public function generate(Request $request, StabilityService $service)
    {
        $request->validate([
            'imagen' => 'required|image|max:10240', // Aumentamos a 10MB por seguridad
            'prompt' => 'required|string',
        ]);

        // Definimos las rutas temporales
        $uploadedFile = $request->file('imagen');
        $tempPath = 'temp/' . Str::random(10) . '.png';

        try {
            // 🚀 INTERVENTION IMAGE: Redimensionar la imagen a la medida exacta permitida
            // Usamos 'fit' para mantener la proporción sin estirar.
            $imageResized = Image::make($uploadedFile->getRealPath())
                ->fit(config('services.stability.default_width'), config('services.stability.default_height'))
                ->encode('png'); // Convertimos a PNG para compatibilidad

            // Guardamos la imagen redimensionada temporalmente en el storage local
            Storage::disk('local')->put($tempPath, $imageResized);
            $fullTempPath = Storage::disk('local')->path($tempPath);

            // 📤 Pasamos la ruta de la imagen YA REDIMENSIONADA al servicio
            $urlResult = $service->transformGarden($fullTempPath, $request->prompt);
            
            return response()->json([
                'imagen' => $urlResult
            ]);

        } catch (\Exception $e) {
            // 💡 Si falla, intentamos devolver el mensaje JSON raw de la IA si es posible
            $rawErrorMessage = $e->getMessage();
            $decodedError = json_decode($rawErrorMessage, true);

            if ($decodedError && isset($decodedError['message'])) {
                return response()->json(['error' => 'Error de la IA: '
                . $decodedError['message']], 500);
            }

            return response()->json(['error' => 'Error general: ' . $e->getMessage()], 500);

        } finally {
            // 🧹 Limpieza: Borramos el archivo temporal para no llenar el servidor
            if (Storage::disk('local')->exists($tempPath)) {
                Storage::disk('local')->delete($tempPath);
            }
        }
    }
}