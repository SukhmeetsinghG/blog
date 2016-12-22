<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products1 extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'products1';
    protected $fillable = array('name', 'title', 'description','price','category_id','brand_id','created_at_ip', 'updated_at_ip');
}
