<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'name', 'email', 'number', 'address', 'transaction_total', 'transaction_status'
    ];

    protected $hidden = [
        
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    public function transactionStatusLabel()
    {
        switch($this->transaction_status)
        {
            case 0:
                return "Pending";
            break;
            case 1:
                return "Success";
            break;
            case 2:
                return "Failed";
            break;
        }
    }

    public function scopePending($query)
    {
        return $query->where('transaction_status', 0);
    }

    public function scopeSuccess($query)
    {
        return $query->where('transaction_status', 1);
    }

    public function scopeFailed($query)
    {
        return $query->where('transaction_status', 2);
    }
}
