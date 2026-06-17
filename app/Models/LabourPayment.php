<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabourPayment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function labourBill() { return $this->belongsTo(LabourBill::class); }
}