<?php

namespace Modules\Contact\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contacts';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Contact\database\factories\ContactFactory::new();
    }
}
