<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Tutorial extends Model {

    protected $table = 'tutorials';

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->sort = $data['sort'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->ar_desc = $data['ar_desc'];
        $this->en_desc = $data['en_desc'];
        $this->image = $file;
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $tutorial = $this->find($id);
        $tutorial->sort = $data['sort'];
        $tutorial->ar_name = $data['ar_name'];
        $tutorial->en_name = $data['en_name'];
        $tutorial->ar_desc = $data['ar_desc'];
        $tutorial->en_desc = $data['en_desc'];
        if ($file) {
            $path = public_path('upload/tutorials/');
            $filename = $tutorial->image;
            File::Delete($path . $filename);
            $tutorial->image = $file;
        }
        return $tutorial->save();
    }

    public function remove($id) {
        $tutorial = $this->find($id);
        $path = public_path('upload/tutorials/');
        $filename = $tutorial->image;
        File::Delete($path . $filename);
        return $tutorial->delete();
    }

}
