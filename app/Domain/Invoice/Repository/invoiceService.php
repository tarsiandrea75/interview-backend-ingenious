<?php

namespace App\Domain\Invoice\Repository;

use App\Domain\Invoice\Entity\Invoice;

class InvoiceRepository
{
    public function save(Invoice $invoice): void
    {
        $invoice->save();
    }
}
