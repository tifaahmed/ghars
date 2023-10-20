<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class UserFile extends Model {

    protected $table = 'users_files';

    //
    public function User() {
        return $this->hasOne(UserFile::class, 'id', 'user_id');
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($id, $ar_name, $en_name,$active, $file) {
        $new = new UserFile();
        $new->user_id = $id;
        $new->ar_name = $ar_name;
        $new->en_name = $en_name;
        $new->active = $active;
        $new->file = $file;
        return $new->save();
    }

    public function edit($id, $active) {
        $file = $this->find($id);
        $file->active = $active;
        return $file->save();
    }

    public function remove($id) {
        $product = $this->find($id);
        $path = public_path('upload/companies/');
        $filename = $product->image;
        File::Delete($path . $filename);
        return $product->delete();
    }

}
