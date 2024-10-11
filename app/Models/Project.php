<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function tasks(){
        return $this->hasMany(Task::class);
    }
    
    protected $fillable = [
        'project_name',
        'description',
        'start_date',
    ];
}
