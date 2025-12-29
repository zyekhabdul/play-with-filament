<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
     * Logic otomatis untuk memperbarui status pada FeeBill saat payment dibuat
     */
    protected static function booted()
    {

    static::creating(function (Payment $payment) {
        $payment->user_id = Auth::id();
    });

    static::created(function (Payment $payment) {
        $payment->feeBill->recalculatePaymentStatus();
    });

    static::deleted(function (Payment $payment) {
        $payment->feeBill->recalculatePaymentStatus();
    });
    }
    /**
     * Relasi: Pembayaran ini merujuk ke satu tagihan (FeeBill)
     */
    public function feeBill()
    {
        return $this->belongsTo(FeeBill::class, 'fee_bill_id', 'fee_bill_id');
    }

    /**
     * Relasi: User (bendahara/admin) yang mencatat pembayaran ini
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
