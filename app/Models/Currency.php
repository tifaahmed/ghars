<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class Currency extends Model {

    protected $table = 'currencies';

    //

    public function getList() {
        $lang = Config::get('app.locale');
        return $this->orderBy('sort', 'asc')->pluck($lang . '_name', 'id')->toArray();
    }

    public function getListt() {
        $lang = Config::get('app.locale');
        return $this->orderBy('sort', 'desc')->pluck($lang . '_name', 'en_currency')->toArray();
    }

    public function getAll() {
        return $this->get();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function edit($id, $data) {
        $currency = $this->find($id);
        $currency->equal = $data['equal'];
        return $currency->save();
    }

}
