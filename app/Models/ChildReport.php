<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class ChildReport extends Model {

    protected $table = 'childern_reports';

    //
    public function Child() {
        return $this->hasOne(Child::class, 'id', 'child_id');
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($id, $ar_name, $en_name, $active, $file) {
        $new = new ChildReport();
        $new->child_id = $id;
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
        $path = public_path('upload/childern/');
        $filename = $report->file;
        File::Delete($path . $filename);
        return $report->delete();
    }

}
