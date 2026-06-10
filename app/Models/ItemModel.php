<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToCompany;
use Illuminate\Database\Eloquent\SoftDeletes;


class ItemModel extends Model
{
    use HasFactory, BelongsToCompany;
    
    use SoftDeletes;

    protected $table = 'items';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'satuan'
    ];
}
