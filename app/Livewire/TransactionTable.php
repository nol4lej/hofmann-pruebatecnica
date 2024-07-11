<?php

namespace App\Livewire;

use Livewire\Component;

class TransactionTable extends Component
{
    public $transactions;
    public function mount($transactions)
    {
        $this->transactions = $transactions;
    }

    public function render()
    {
        return view('livewire.transaction-table');
    }
}
