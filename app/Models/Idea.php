<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model {

    //
    protected $table = 'ideas';

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data) {
        $this->type = $data['type'];
        $this->name = $data['name'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->message = $data['message'];
        $this->reply = "";
        return $this->save();
    }

    public function update_seen($id) {
        $one = $this->find($id);
        $one->seen = 'yes';
        return $one->save();
    }

    public function edit($id, $data) {
        $idea = $this->find($id);
        if ($data['reply'] != "") {
            $idea->reply = $data['reply'];
        } else {
            $idea->reply = "";
        }
        return $idea->save();
    }

}
