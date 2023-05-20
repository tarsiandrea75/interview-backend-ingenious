<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'product_name', 'product_quantity', 'price_per_item', 'created_at'];

    public function isApprovable(): bool
    {
        // Check if the invoice can be approved based on some business logic
        // Here, we simply check if the product quantity is greater than zero
        return $this->product_quantity > 0;
    }

    public function isRejectable(): bool
    {
        // Check if the invoice can be rejected based on some business logic
        // Here, we simply check if the product quantity is zero
        return 0 == $this->product_quantity;
    }
}
