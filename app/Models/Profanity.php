<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use WGT\Models\Profanity\ProfanityIgnore;

class Profanity extends Model
{
    use SoftDeletes;

    protected $fillable = ['word', 'user_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function profanityIgnores(): HasMany
    {
        return $this->hasMany(ProfanityIgnore::class);
    }

    /**
     * @param array $data
     * @return Builder
     */
    public static function getProfanitiesIgnored(array $dataFilter): Builder
    {
        return Profanity::whereDoesntHave(
            'profanityIgnores',
            function (Builder $query) use ($dataFilter) {
                $query->where(function(Builder $subQuery) use ($dataFilter) {
                    $subQuery->where(function(Builder $subQueryFilter) use ($dataFilter) {
                        $subQueryFilter->where($dataFilter[0]);
                    });
                    for($i=1; $i<count($dataFilter); $i++) {
                        $subQuery->orWhere(function(Builder $subQueryFilter) use ($dataFilter, $i) {
                            $subQueryFilter->where($dataFilter[$i]);
                        });
                    }
                });
            });
    }
}
