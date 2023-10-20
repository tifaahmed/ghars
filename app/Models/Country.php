<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class Country extends Model {

    protected $table = 'countries';

    //

    public function getList() {
        $lang = Config::get('app.locale');
        return $this->orderBy($lang . '_name', 'asc')->pluck($lang . '_name', 'id')->toArray();
    }

    public function getListt() {
        $lang = Config::get('app.locale');
        return $this->orderBy('en_name', 'desc')->pluck($lang . '_name', 'en_name')->toArray();
    }

    public function getListCode() {
        return $this->orderBy('code', 'asc')->pluck('code', 'id')->toArray();
    }

    public function getAll() {
        return $this->get();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function edit($id, $data) {
        $country = $this->find($id);
        $country->active = $data['active'];
        $country->ar_name = $data['ar_name'];
        $country->en_name = $data['en_name'];
        $country->code = $data['code'];
        $country->ar_address = $data['ar_address'];
        $country->en_address = $data['en_address'];
        $country->headquarter_1 = $data['headquarter_1'];
        $country->headquarter_2 = $data['headquarter_2'];
        $country->delegate_1 = $data['delegate_1'];
        $country->delegate_2 = $data['delegate_2'];
        return $country->save();
    }

    public function remove($id) {
        $country = $this->find($id);
        return $country->delete();
    }

}
