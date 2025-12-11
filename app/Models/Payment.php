<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'fee_bill_id',
        'user_id',
        'payment_date',
        'amount_paid',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount_paid' => 'integer',
    ];

    /**
     * The fee bill this payment applies to
     */
    public function feeBill()
    {
        return $this->belongsTo(FeeBill::class, 'fee_bill_id', 'fee_bill_id');
    }

    /**
     * The user (treasurer) who recorded the payment
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}