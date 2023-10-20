<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Action extends Model {

    protected $table = 'actions';

    //

    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getAll() {
        return $this->orderBy('id', 'desc')->get();
    }

    public function getBySeller($ids) {
        return $this->whereIn('user_id', $ids)->orderBy('id', 'desc')->get();
    }

    public function search($data) {
        $result = $this;
        if (isset($data['user_id']) && $data['user_id'] != '') {
            $result = $result->where('user_id', $data['user_id']);
        }
        if (isset($data['start_date']) && $data['start_date'] != '') {
            $result = $result->where('created_at', '>=', $data['start_date'] . ' 00:00:00');
        }
        if (isset($data['end_date']) && $data['end_date'] != '') {
            $result = $result->where('created_at', '<=', $data['end_date'] . ' 23:59:59');
        }
        return $result->get();
    }

}
