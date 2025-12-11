<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeBill extends Model
{
    use HasFactory;

    protected $table = 'fee_bills';
    protected $primaryKey = 'fee_bill_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'fee_package_id',
        'month',
        'year',
        'total_amount',
        'payment_status',
    ];

    protected $casts = [
        'year' => 'integer',
        'total_amount' => 'integer',
    ];

    /**
     * The student who owes this bill
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * The fee package related to this bill
     */
    public function feePackage()
    {
        return $this->belongsTo(FeePackage::class, 'fee_package_id', 'fee_package_id');
    }

    /**
     * Payments applied to this bill
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'fee_bill_id', 'fee_bill_id');
    }

    /**
     * Scope for unpaid bills
     */
    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    /**
     * Scope for paid bills
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Get total paid amount (sum of related payments)
     */
    public function getPaidAmountAttribute()
    {
        return $this->payments()->sum('amount_paid');
    }

    /**
     * Convenience: remaining amount
     */
    public function getRemainingAttribute()
    {
        return max(0, $this->total_amount - $this->paid_amount);
    }
}