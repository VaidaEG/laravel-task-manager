<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public function statusTasksList()
    {
        return $this->hasMany('App\Models\Task', 'status_id', 'id');
    }
}
