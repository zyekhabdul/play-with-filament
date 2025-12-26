<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nis',
        'name',
        'class',
        'address',
        'phone_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Fee bills for the student
     */
    public function feeBills()
    {
        return $this->hasMany(FeeBill::class, 'student_id', 'student_id');
    }

    /**
     * Payments through fee bills (convenience)
     */
    public function payments()
    {
        return $this->hasManyThrough(
            Payment::class,
            FeeBill::class,
            'student_id',    // Foreign key on fee_bills table...
            'fee_bill_id',   // Foreign key on payments table...
            'student_id',    // Local key on students table...
            'fee_bill_id'    // Local key on fee_bills table...
        );
    }

    /**
     * Scope active students
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
