<?php
namespace Dinvoice\Models;

use Illuminate\Database\Eloquent\Model;
use Dinvoice\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'view', 'name'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getPathAttribute($value)
    {
        return url($value);
    }
}
