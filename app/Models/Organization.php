<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @method static Organization|Builder query()
 *
 * @property Collection $phones
 * @property Collection $activities
 * @property Building $building
 */
class Organization extends Model
{
    use HasFactory;
    use Searchable;

    public const string TABLE_NAME = 'organizations';
    protected $table = self::TABLE_NAME;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function phones(): HasMany
    {
        return $this->hasMany(OrganizationPhone::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, OrganizationActivity::TABLE_NAME);
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function toSearchableArray(): array
    {
        return array_merge(
            ['title' => $this->title],
            ['id' => (string) $this->id, 'created_at' => $this->created_at->timestamp,]
        );
    }
}
