<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class TeacherReport extends Model {

    protected $table = 'teachers_reports';

    //
    public function Teacher() {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($id, $ar_name, $en_name, $active, $file) {
        $new = new TeacherReport();
        $new->teacher_id = $id;
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
        $report = $this->find($id);
        $path = public_path('upload/teachers/');
        $filename = $report->file;
        File::Delete($path . $filename);
        return $report->delete();
    }

}
