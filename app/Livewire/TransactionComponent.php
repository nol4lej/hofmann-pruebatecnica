<?php

namespace App\Livewire;

use App\Services\UserDataService;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class TransactionComponent extends Component
{
    public $transactions;
    public $loader = true;
    public $error = false;


    public function mount()
    {
        $this->loadTransactions();
    }

    public function loadTransactions()
    {
        $this->loader = true;
        $userDataService = new UserDataService();
        try {
            $this->transactions = $userDataService->getListTableUser();
        } catch (Exception $e) {
            $this->error = "Error al obtener los datos: " . $e->getMessage();
            Log::error($this->error);
        } finally {
            $this->loader = false;
        }
    }

    public function render()
    {
        return view('livewire.transaction-component');
    }
}
