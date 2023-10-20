<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class TeacherVideo extends Model {

    protected $table = 'teachers_videos';

    //
    public function Teacher() {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->active = $data['active'];
        $this->teacher_id = $data['teacher_id'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->link = $data['link'];
        $this->image = $file;
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $member = $this->find($id);
        $member->active = $data['active'];
        $member->ar_name = $data['ar_name'];
        $member->en_name = $data['en_name'];
        $member->link = $data['link'];
        if ($file) {
            $path = public_path('upload/teachers_videos/');
            $filename = $member->image;
            File::Delete($path . $filename);
            $member->image = $file;
        }
        return $member->save();
    }

    public function remove($id) {
        $report = $this->find($id);
        $path = public_path('upload/teachers_videos/');
        $filename = $report->image;
        File::Delete($path . $filename);
        return $report->delete();
    }

}
