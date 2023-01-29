<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturePermission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'feature_permissions';
    public $fillable = ['role_id', 'feature_id','operation_id'];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }


    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }


}