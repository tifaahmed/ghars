<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Slider extends Model {

    protected $table = 'slider';

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->ar_desc = $data['ar_desc'];
        $this->en_desc = $data['en_desc'];
        $this->link = $data['link'];
        $this->sort = $data['sort'];
        $this->image = $file;
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $slider = $this->find($id);
        $slider->active = $data['active'];
        $slider->ar_name = $data['ar_name'];
        $slider->en_name = $data['en_name'];
        $slider->ar_desc = $data['ar_desc'];
        $slider->en_desc = $data['en_desc'];
        $slider->link = $data['link'];
        $slider->sort = $data['sort'];
        if ($file) {
            $path = public_path('upload/slider/');
            $filename = $slider->image;
            File::Delete($path . $filename);
            $slider->image = $file;
        }
        return $slider->save();
    }

    public function remove($id) {
        $slider = $this->find($id);
        $path = public_path('upload/slider/');
        $filename = $slider->image;
        File::Delete($path . $filename);
        return $slider->delete();
    }

}
