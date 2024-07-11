<?php

namespace App\Livewire;

use App\Services\UserDataService;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class TransactionModal extends Component
{
    public $transaction;
    public $user;
    public $error;
    public $loader = false;
    protected $userDataService;

    public function mount($transaction)
    {
        $this->userDataService = new UserDataService();
        $this->transaction = $transaction;

        try {
            $users = $this->userDataService->getUsers();
            $this->user = $this->userDataService->find($users, $this->transaction['code']);
        } catch (Exception $e) {
            $this->error = "Error al obtener los datos: " . $e->getMessage();
            Log::error($this->error);
        } finally {
            $this->loader = false;
        }
    }

    public function render()
    {
        return view('livewire.transaction-modal');
    }
}
