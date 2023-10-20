<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Site extends Model {

    protected $table = 'site';

    public function getData() {
        return self::first();
    }

    public function edit($data, $file = false, $filee = false, $fileee = false) {
        $path = public_path('upload/site/');

        $this->ar_title = $data['ar_title'];
        $this->en_title = $data['en_title'];
        $this->ar_desc = $data['ar_desc'];
        $this->en_desc = $data['en_desc'];
        $this->tags = $data['tags'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->whatsapp = $data['whatsapp'];
        $this->map = $data['map'];
        $this->ios = $data['ios'];
        $this->android = $data['android'];
        if ($file) {
            $filename = $this->childern;
            File::Delete($path . $filename);
            $this->childern = $file;
        }
        if ($filee) {
            $filenamee = $this->families;
            File::Delete($path . $filenamee);
            $this->families = $filee;
        }
        if ($fileee) {
            $filenameee = $this->teachers;
            File::Delete($path . $filenameee);
            $this->teachers = $fileee;
        }
        return $this->save();
    }

}
