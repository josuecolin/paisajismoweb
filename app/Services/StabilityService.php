<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StabilityService
{
    public function transformGarden($imagePath, $prompt)
    {
        $engineId = 'stable-diffusion-xl-1024-v1-0';
        $url = "https://api.stability.ai/v1/generation/{$engineId}/image-to-image";

        // Stability requiere enviar los datos como Multipart
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.stability.key'),
            'Accept' => 'application/json',
        ])->attach(
            'init_image', file_get_contents($imagePath), 'image.png'
        )->post($url, [
            'text_prompts[0][text]' => $prompt,
            'text_prompts[0][weight]' => 1,
            'image_strength' => 0.35, // 0.1 a 1.0 (cuánto respeta la foto original)
            'cfg_scale' => 7,
            'samples' => 1,
            'steps' => 30,
        ]);

        if ($response->successful()) {
            $imageData = $response->json()['artifacts'][0]['base64'];
            $imageName = 'ai/' . Str::random(10) . '.png';
            Storage::disk('public')->put($imageName, base64_decode($imageData));
            return Storage::url($imageName);
        }

        throw new \Exception('Error IA: ' . $response->body());
    }
}