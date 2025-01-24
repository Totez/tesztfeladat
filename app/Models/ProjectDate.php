<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'start',
        'finish',
        'memo'
    ];

    /**
     * Get the project associated with the date.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
