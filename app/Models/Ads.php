<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Ads extends Model {

    protected $table = 'ads';

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->en_name = $data['en_name'];
        $this->ar_name = $data['ar_name'];
        $this->type = $data['type'];
        $this->link = $data['link'];
        $this->image = $file;
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $ads = $this->find($id);
        $ads->en_name = $data['en_name'];
        $ads->ar_name = $data['ar_name'];
        $ads->type = $data['type'];
        $ads->link = $data['link'];
        if ($file) {
            $path = public_path('upload/ads/');
            $filename = $ads->image;
            File::Delete($path . $filename);
            $ads->image = $file;
        }
        return $ads->save();
    }

    public function remove($id) {
        $ads = $this->find($id);
        $path = public_path('upload/ads/');
        $filename = $ads->image;
        File::Delete($path . $filename);
        return $ads->delete();
    }

}
