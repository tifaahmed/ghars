<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {

    //
    protected $table = 'newsletters';

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function remove($id) {
        $newsletter = $this->find($id);
        return $newsletter->delete();
    }

}
