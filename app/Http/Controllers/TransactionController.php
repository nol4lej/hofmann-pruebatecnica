<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Services\UserDataService;

class TransactionController extends Controller
{
    protected $userDataService;

    public function __construct(UserDataService $userDataService)
    {
        $this->userDataService = $userDataService;
    }

    public function update(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'github' => 'required|url',
            'code' => 'required|string',
        ]);

        // Obtener los datos del formulario
        $id = intval($request->input('id'));
        $amountString = $request->input('amount');
        $amount = intval(str_replace('.', '', $amountString)); // Eliminar puntos y convertir a entero
        $date = Carbon::parse($request->input('date'))->toISOString();
        $github = $request->input('github');
        $code = $request->input('code');

        // Preparar los datos a enviar
        $dataToSend = [
            'id' => $id,
            'code' => $code,
            'amount' => $amount,
            'date' => $date,
            'github' => $github,
        ];

        try {
            $this->userDataService->sendUserData($dataToSend);
            return response()->json([
                'message' => 'Los cambios han sido guardados correctamente y enviados a la API SendUser.',
                'data' => $dataToSend
            ]);

        } catch (Exception $e) {
            // Manejar cualquier excepción y devolver una respuesta de error
            return response()->json(['message' => 'Ocurrió un error al intentar guardar los cambios: ' . $e->getMessage()], 500);
        }
    }
}
