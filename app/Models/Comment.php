<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->belongsTo(Post::class);
    }

    public function getCreatedAtAttribute($value)
{
    try {
        $carbonDate = Carbon::parse($value);
        return $carbonDate->diffForHumans();

    } catch (\Exception $e) {
        // Handle the error gracefully
        return $value;
    }
}
}
