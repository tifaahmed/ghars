<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model {

    protected $table = 'visitors';

    //

    public function getAll() {
        return $this->orderBy('id', 'desc')->get();
    }

}
