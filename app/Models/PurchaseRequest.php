<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function tax(){
        return $this->belongsTo(Vendor::class, 'tax_id');
    }

    public function details(){
        return $this->hasMany(PurchaseRequestDetail::class);
    }
}
