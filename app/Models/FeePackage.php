<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePackage extends Model
{
    use HasFactory;

    protected $table = 'fee_packages';
    protected $primaryKey = 'fee_package_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'academic_year',
        'amount',
        'description',
    ];

    protected $casts = [
        'amount' => 'integer',
    ];

    /**
     * Bills generated from this package
     */
    public function feeBills()
    {
        return $this->hasMany(FeeBill::class, 'fee_package_id', 'fee_package_id');
    }
}