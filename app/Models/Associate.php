<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    protected $fillable = [
        'name',
        'associate_id',
        'phone_number',
    ];

    /**
     * Auto Generate Associate ID
     */
    public static function generateAssociateId()
    {
        $lastAssociate = self::orderBy('id', 'desc')->first();

        if ($lastAssociate && $lastAssociate->associate_id) {

            $lastId = explode('-', $lastAssociate->associate_id);
            $number = isset($lastId[2]) ? (int)$lastId[2] : 0;

            $newNumber = $number + 1;
            $newNumber = str_pad($newNumber, 5, '0', STR_PAD_LEFT);

            return 'AL-AS-' . $newNumber;

        } else {
            return 'AL-AS-00001';
        }
    }
}
