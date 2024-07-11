<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Exception;

class UserDataService
{
    /**
     * Obtener la lista de transacciones de usuarios
     * 
     * @throws Exception
     * @return array
     */
    public function getListTableUser()
    {
        $response = Http::get(env('LIST_TABLE_USERS'));

        if (!$response->successful()) {
            throw new Exception("Error al obtener los datos de usuarios: " . $response->status());
        }

        $transactions = $response->json();

        foreach ($transactions as &$transaction) {
            $transaction['amount'] = number_format($transaction['amount'], 0, ',', '.');
            $transaction['date'] = Carbon::parse($transaction['date'])->format('d-m-Y');
        }

        return $transactions;
    }

    /**
     * Obtener datos de usuario
     * 
     * @throws Exception
     * @return array
     */
    public function getUsers()
    {
        $response = Http::get(env('GET_USERS'));

        if (!$response->successful()) {
            throw new Exception("Error al obtener los datos de usuarios: " . $response->status());
        }

        return $response->json();
    }

    public function find($users, $codeToFind)
    {
        $filtered = array_filter($users, function($item) use ($codeToFind) {
            return $item['code'] == $codeToFind;
        });

        return $filtered;

    }

        /**
     * Enviar datos a la API SendUser
     * 
     * @param array $data Datos a enviar a la API
     * @return bool true si la solicitud fue exitosa, false si hubo un error
     * @throws Exception Si hay un error en la solicitud HTTP
     */
    public function sendUserData(array $data)
    {
        try {
            $response = Http::post(env('SEND_USER'), $data);

            if (!$response->successful()) {
                throw new Exception("Error al enviar los datos a la API SendUser: " . $response->status());
            }

            return true;
        } catch (Exception $e) {
            throw new Exception("Error al enviar los datos a la API SendUser: " . $e->getMessage());
        }
    }

}
