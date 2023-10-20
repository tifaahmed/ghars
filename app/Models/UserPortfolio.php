<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class UserPortfolio extends Model {

    protected $table = 'users_portfolio';

    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Images() {
        return $this->hasMany(UserPortfolioImage::class, 'portfolio_id', 'id');
    }

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->user_id = $data['user_id'];
        $this->active = $data['active'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->ar_desc = $data['ar_desc'];
        $this->en_desc = $data['en_desc'];
        $this->image = $file;
        $this->save();
        return $this->id;
    }

    public function edit($id, $data, $file = false) {
        $portfolio = $this->find($id);
        $portfolio->user_id = $data['user_id'];
        $portfolio->active = $data['active'];
        $portfolio->ar_name = $data['ar_name'];
        $portfolio->en_name = $data['en_name'];
        $portfolio->ar_desc = $data['ar_desc'];
        $portfolio->en_desc = $data['en_desc'];
        if ($file) {
            $path = public_path('upload/portfolio/');
            $filename = $portfolio->image;
            File::Delete($path . $filename);
            $portfolio->image = $file;
        }
        return $portfolio->save();
    }

    public function remove($id) {
        $portfolio = $this->find($id);
        $path = public_path('upload/portfolio/');
        $filename = $portfolio->image;
        File::Delete($path . $filename);
        return $portfolio->delete();
    }

}
