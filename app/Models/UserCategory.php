<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model {

    protected $table = 'users_categories';

    //
    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function add($id, $category_id) {
        $new = new UserCategory();
        $new->user_id = $id;
        $new->category_id = $category_id;
        return $new->save();
    }

    public function removeByUser($id) {
        return $this->where('user_id', $id)->delete();
    }

    public function removeByCategory($id) {
        return $this->where('category_id', $id)->delete();
    }

}
