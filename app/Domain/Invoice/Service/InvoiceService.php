<?php

namespace App\Domain\Invoice\Service;

use App\Domain\Invoice\DTO\InvoiceDTO;
use App\Domain\Invoice\Entity\Invoice;
use App\Domain\Invoice\Repository\InvoiceRepository;

class InvoiceService
{
    private InvoiceRepository $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function approveInvoice(int $id): JsonResponse
    {
        $invoice = \App\Models\Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found.'], 404);
        }

        if (!$this->approvalService->isApprovable($invoice)) {
            return response()->json(['message' => 'Invoice cannot be approved.'], 400);
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

        if (!$this->approvalService->isRejectable($invoice)) {
            return response()->json(['message' => 'Invoice cannot be rejected.'], 400);
        }

        try {
            $this->invoiceService->rejectInvoice($invoice);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

        $invoiceDTO = $this->invoiceService->mapToDTO($invoice);

        return response()->json($invoiceDTO);
    }


    public function mapToDTO(Invoice $invoice): InvoiceDTO
    {
        // Map the Invoice entity to InvoiceDTO
        $invoiceDTO = new InvoiceDTO();
        $invoiceDTO->id = $invoice->id;
        $invoiceDTO->productName = $invoice->product_name;
        $invoiceDTO->productQuantity = $invoice->product_quantity;
        $invoiceDTO->pricePerItem = $invoice->price_per_item;
        $invoiceDTO->createdAt = $invoice->created_at->toDateTimeString();
        $invoiceDTO->approved = $invoice->approved;
        return $invoiceDTO;
    }
}

