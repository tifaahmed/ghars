<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    //
    protected $table = 'contacts';

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data) {
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
        $contact = $this->find($id);
        if ($data['reply'] != "") {
            $contact->reply = $data['reply'];
        } else {
            $contact->reply = "";
        }
        return $contact->save();
    }

    public function remove($id) {
        $contact = $this->find($id);
        return $contact->delete();
    }

    public function delByComplaint($id) {
        return $this->where('complaint_id', $id)->delete();
    }

}
