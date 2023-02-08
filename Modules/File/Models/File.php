<?php

namespace Modules\File\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'files';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\File\database\factories\FileFactory::new();
    }
}
