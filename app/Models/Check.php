<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelIdea\Helper\App\Models\_IH_Check_QB;
use Symfony\Component\HttpFoundation\Response;

class Check extends Model
{
    use HasFactory;
    use Prunable;

    protected $fillable = [
        'response_code',
        'response_body'
    ];

    public function prunable(): Check
    {
        return static::where('created_at', '<=', now()->day(1));
    }

    public function endpoint(): BelongsTo
    {
        return $this->belongsTo(Endpoint::class);
    }

    public function isSuccessful(): bool
    {
        return $this->response_code >= 200 && $this->response_code < 300;
    }

    public function statusText(): string
    {
        return Response::$statusTexts[$this->response_code] ?? 'Unknown';
    }

    public function previous(): Check|HasMany|_IH_Check_QB|null
    {
        return $this->endpoint->checks()->orderBy('id', 'desc')->where('id', '<', $this->id)->first();
    }
}
