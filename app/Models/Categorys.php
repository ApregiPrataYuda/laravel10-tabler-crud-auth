<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorys extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ms_category';
    protected $primaryKey = 'id_category';
    public $incrementing = true;
    public $timestamps = true;
}
