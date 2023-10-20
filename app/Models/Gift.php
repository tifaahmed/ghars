<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;
use File;

class Gift extends Model {

    protected $table = 'gifts';

    //

    public function getAll() {
        return $this->where('active', '!=', 'delete')->get();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->sort = $data['sort'];
        $this->amount = $data['amount'];
        $this->type = $data['type'];
        $this->image = $file;
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $gift = $this->find($id);
        $gift->active = $data['active'];
        $gift->ar_name = $data['ar_name'];
        $gift->en_name = $data['en_name'];
        $gift->sort = $data['sort'];
        $gift->amount = $data['amount'];
        $gift->type = $data['type'];
        if ($file) {
            $path = public_path('upload/gifts/');
            $filename = $gift->image;
            File::Delete($path . $filename);
            $gift->image = $file;
        }
        return $gift->save();
    }

    public function remove($id) {
        $gift = $this->find($id);
        $gift->active = 'delete';
        $gift->deleted_at = now();
        return $gift->save();
    }

}
