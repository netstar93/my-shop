<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Attributeset;
class Attribute extends Model
{
    protected $table = "product_attribute";
    public $timestamps = false;
    protected $fillable = ['name','type','options','status'];    

    /*
     * GET ALL OTHER ATTRIBUTES BY ATTRIBUTE SET ID
     */

    public function getOtherAttributes($set_id)
    {
        $data = array();
        $set_data = Attributeset:: findOrFail($set_id);
        $attributes_arr = explode(',', $set_data->attribute_ids);
        try {
            foreach ($attributes_arr as $attr) {
                $at = Attribute::find($attr);
                if (isset($at->status) && $at->status == 1) $data[] = $at;
            }
        } catch (ErrorException $e) {
        }
        return $data;
    }

    public function load($id) {
        return $at = Attribute::find($id);
        
        //if (isset($at->name)) return $at->name;
    }

}
