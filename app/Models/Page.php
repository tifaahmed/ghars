<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Page extends Model {

    //
    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data) {
        $this->ar_title = $data['ar_title'];
        $this->en_title = $data['en_title'];
        $this->ar_desc = $data['ar_desc'];
        $this->en_desc = $data['en_desc'];
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $page = $this->find($id);
        $page->ar_title = $data['ar_title'];
        $page->en_title = $data['en_title'];
        $page->ar_desc = $data['ar_desc'];
        $page->en_desc = $data['en_desc'];
        if ($file) {
            $path = public_path('upload/pages/');
            $filename = $page->image;
            File::Delete($path . $filename);
            $page->image = $file;
        }
        return $page->save();
    }

    public function remove($id) {
        $page = $this->find($id);
        return $page->delete();
    }

}
