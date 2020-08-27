<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';
    protected $fillable = ['name'];

    public $timestamps = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
