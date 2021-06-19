<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'item_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:m/d/Y'
    ];

    public function item() {
        return $this->belongsTo('App\Item');
    }
}
