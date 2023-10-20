<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;
use File;

class Category extends Model {

    protected $table = 'categories';

    //

    public function Steps() {
        return $this->hasMany(CategoryStep::class, 'category_id', 'id')->where('active', '!=', 'delete');
    }

    public function getList() {
        $lang = Config::get('app.locale');
        return $this->orderBy($lang . '_name', 'asc')->pluck($lang . '_name', 'id')->toArray();
    }

    public function getAll() {
        return $this->where('active', '!=', 'delete')->get();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->image = $file;
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $category = $this->find($id);
        $category->active = $data['active'];
        $category->ar_name = $data['ar_name'];
        $category->en_name = $data['en_name'];
        if ($file) {
            $path = public_path('upload/categories/');
            $filename = $category->image;
            File::Delete($path . $filename);
            $category->image = $file;
        }
        return $category->save();
    }

    public function remove($id) {
        $category = $this->find($id);
        $category->active = 'delete';
        $category->deleted_at = now();
        return $category->save();
    }

}
