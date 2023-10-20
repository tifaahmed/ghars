<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class UserPortfolioImage extends Model {

    protected $table = 'users_portfolio_images';

    //
    public function Portfolio() {
        return $this->hasOne(UserPortfolio::class, 'id', 'portfolio_id');
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($id, $file) {
        $new = new UserPortfolioImage();
        $new->portfolio_id = $id;
        $new->image = $file;
        return $new->save();
    }

    public function remove($id) {
        $portfolio = $this->find($id);
        $path = public_path('upload/portfolio/');
        $filename = $portfolio->image;
        File::Delete($path . $filename);
        return $portfolio->delete();
    }

}
