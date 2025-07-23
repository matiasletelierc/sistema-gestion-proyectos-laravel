<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'status',
        'responsible',
        'amount'
    ];

    protected $casts = [
        'start_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public static function getStatusOptions()
    {
        return [
            'planning' => 'Planificación',
            'in_progress' => 'En Progreso',
            'completed' => 'Completado',
            'cancelled' => 'Cancelado'
        ];
    }
}
