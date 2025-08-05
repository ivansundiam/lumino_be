<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    use HasUuids;

    public const REGULAR_USER = 1;
    public const MODERATOR = 2;

    protected $fillable = [
      "name",
      "description"
    ];

    public function uniqueIds()
    {
        return ['uuid'];
    }

    public function users(): BelongsTo {
        return $this->BelongsTo(User::class);
    }
}
