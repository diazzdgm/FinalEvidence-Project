<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        try {
            $order = Order::find($id);

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            return response()->json([
                'id' => $order->id, // Es bueno devolver el id también
                'status' => $order->Status,
                'label_path' => $order->label_path ? asset('storage/' . $order->label_path) : null, // Construir URL manualmente
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error getting order information'], 500);
        }
    }

    public function downloadLabel(Order $order): StreamedResponse // Corregido a StreamedResponse
    {
        \Log::info('Download attempt for order ID: ' . $order->id . ' with label_path: ' . $order->label_path);

        if (!$order->label_path) {
            \Log::warning('downloadLabel: Label path is empty for order ID: ' . $order->id);
            abort(404, 'Label not found.');
        }

        $filePath = storage_path('app/public/' . $order->label_path);
        \Log::info('downloadLabel: Constructed file path: ' . $filePath);

        if (!file_exists($filePath)) {
            \Log::error('downloadLabel: File does not exist at path: ' . $filePath . ' for order ID: ' . $order->id);
            abort(404, 'File does not exist.');
        }
        \Log::info('downloadLabel: File confirmed to exist at path: ' . $filePath);

        $fileName = basename($filePath);
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $mimeTypes = [
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            'pdf' => 'application/pdf',
            // Añade más tipos MIME si es necesario
        ];

        $contentType = $mimeTypes[$extension] ?? 'application/octet-stream';

        $headers = [
            'Content-Type'        => $contentType,
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"', // Asegurar comillas alrededor del filename
            'Content-Length'      => filesize($filePath), // Importante para algunos clientes/proxies
            'Pragma'              => 'public',
            'Expires'             => '0',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Last-Modified'       => gmdate('D, d M Y H:i:s', filemtime($filePath)).' GMT',
        ];

        // Devolver StreamedResponse para enviar el archivo
        return response()->stream(function() use ($filePath) {
            $handle = fopen($filePath, 'rb');
            fpassthru($handle);
            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Upload a label for the specified order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadLabelFromVue(Request $request, $orderId) // Método renombrado y $orderId añadido
    {
        try {
            $order = Order::find($orderId);

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            // Modificación temporal para diagnóstico: se relaja la validación de tipo de imagen
            $request->validate([
                'label_image' => 'required|file|max:2048', // Se eliminó 'image' y 'mimes'
            ]);

            if ($request->hasFile('label_image')) {
                // Eliminar la imagen anterior si existe para evitar acumular archivos no utilizados
                // Usar funciones nativas de PHP para evitar la dependencia de finfo en Storage
                if ($order->label_path) {
                    $oldFilePath = storage_path('app/public/' . $order->label_path);
                    if (file_exists($oldFilePath)) {
                        @unlink($oldFilePath); // Usar @ para suprimir errores si el archivo no se puede eliminar
                    }
                }

                $file = $request->file('label_image');
                $originalExtension = $file->getClientOriginalExtension();
                
                $newFilename = uniqid('label_') . '.' . $originalExtension;
                $destinationPath = storage_path('app/public/labels'); // Ruta física completa al directorio de destino

                // Asegurarse de que el directorio de destino exista
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0775, true); // Crear recursivamente con permisos adecuados
                }

                // Mover el archivo usando el método move() de UploadedFile, que usa move_uploaded_file()
                if ($file->move($destinationPath, $newFilename)) {
                    $storedPath = 'labels/' . $newFilename; // Ruta relativa para la base de datos y Storage::url()
                    $order->label_path = $storedPath; // Cambiado a label_path
                    $order->save();

                    // Construir la URL manualmente para evitar la dependencia de finfo en Storage::url()
                    $url = asset('storage/' . $storedPath);

                    return response()->json(['message' => 'Label uploaded successfully.', 'path' => $url], 200);
                } else {
                    // Log y error si move_uploaded_file falla
                    \Log::error('Failed to move uploaded file for order: ' . $orderId);
                    return response()->json(['error' => 'Server error: Could not move uploaded file.'], 500);
                }
            }

            return response()->json(['error' => 'No label file found in request.'], 400);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Captura específica para errores de validación
            return response()->json(['message' => 'Validation Error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Log más detallado para otras excepciones
            \Log::error('Error in uploadLabelFromVue: ' . $e->getMessage(), [
                'message' => $e->getMessage(), // Añadido para claridad en el log
                'file' => $e->getFile(),       // Añadido para claridad en el log
                'line' => $e->getLine(),       // Añadido para claridad en el log
                'trace' => $e->getTraceAsString(),
                'order_id' => $orderId,
                'file_exists' => $request->hasFile('label_image'),
                'file_is_valid' => $request->file('label_image') ? $request->file('label_image')->isValid() : 'no file',
            ]);
            return response()->json(['error' => 'Server error during label upload. Check logs: ' . $e->getMessage()], 500); // Mensaje de error más específico
        }
    }
}
