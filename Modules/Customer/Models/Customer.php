<?php

namespace Modules\Customer\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\Product;
use Modules\Sale\Models\Sale;

class Customer extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'customers';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    public function sales(){
        return $this->hasMany(Sale::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }


    protected static function newFactory()
    {
        return \Modules\Customer\database\factories\CustomerFactory::new();
    }
}
