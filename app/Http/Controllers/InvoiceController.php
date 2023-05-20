<?php

namespace App\Http\Controllers;

use App\Domain\Invoice\Service\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InvoiceController extends Controller
{
    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }


    public function showInvoice(int $id): JsonResponse
    {
        $invoice = \App\Models\Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found.'], 404);
        }

        $invoiceDTO = $this->invoiceService->mapToDTO($invoice);

        return response()->json($invoiceDTO);
    }

    public function approveInvoice(int $id): JsonResponse
    {
        $invoice = \App\Models\Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found.'], 404);
        }

        try {
            $this->invoiceService->approveInvoice($invoice);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

        $invoiceDTO = $this->invoiceService->mapToDTO($invoice);

        return response()->json($invoiceDTO);
    }

    public function rejectInvoice(int $id): JsonResponse
    {
        $invoice = \App\Models\Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found.'], 404);
        }

        try {
            $this->invoiceService->rejectInvoice($invoice);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

        $invoiceDTO = $this->invoiceService->mapToDTO($invoice);

        return response()->json($invoiceDTO);
    }
}
