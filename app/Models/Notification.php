<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model {

    protected $table = 'notifications';

    //

    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getAll() {
        return $this->where('rel_id', 0)->orderBy('id', 'desc')->get();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->user_id = Auth::user()->id;
        $this->platform = $data['platform'];
        $this->ar_title = $data['ar_title'];
        $this->en_title = $data['en_title'];
        $this->ar_message = $data['ar_message'];
        $this->en_message = $data['en_message'];
        if ($file) {
            $this->image = $file;
        }
        return $this->save();
    }

}
