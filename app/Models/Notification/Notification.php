<?php

namespace App\Models\Notification;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Notification extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
    ];

    protected $allowedFilters = [
        'id',
    ];

    protected $allowedSorts = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }
}
