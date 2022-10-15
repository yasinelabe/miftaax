<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'role_permissions';

    public $fillable = ['role_id', 'asset_id','operation_id'];

    // relationships

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }


}