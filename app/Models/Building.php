<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Building|Builder query()
 *
 * @property Collection organizations
 */
class Building extends Model
{
    use HasFactory;

    public const string TABLE_NAME = 'buildings';
    protected $table = self::TABLE_NAME;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
