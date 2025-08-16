<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPhone extends Model
{
    use HasFactory;

    public const string TABLE_NAME = 'organization_phones';
    protected $table = self::TABLE_NAME;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
}
