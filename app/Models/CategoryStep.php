<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class CategoryStep extends Model {

    protected $table = 'categories_steps';

    //
    public function Category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getListCategory($id) {
        $lang = Config::get('app.locale');
        return $this->where('category_id', $id)->orderBy('sort', 'desc')->pluck($lang . '_name', 'id')->toArray();
    }

    public function getAll() {
        return $this->where('active', '!=', 'delete')->get();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data) {
        $this->category_id = $data['category_id'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->sort = $data['sort'];
        return $this->save();
    }

    public function edit($id, $data) {
        $category_step = $this->find($id);
        $category_step->active = $data['active'];
        $category_step->ar_name = $data['ar_name'];
        $category_step->en_name = $data['en_name'];
        $category_step->sort = $data['sort'];
        return $category_step->save();
    }

    public function remove($id) {
        $category_step = $this->find($id);
        $category_step->active = 'delete';
        $category_step->deleted_at = now();
        return $category_step->save();
    }

}
