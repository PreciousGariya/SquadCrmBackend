<?php

namespace Modules\Sale\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sales';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Sale\database\factories\SaleFactory::new();
    }
}
