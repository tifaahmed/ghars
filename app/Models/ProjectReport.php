<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class ProjectReport extends Model {

    protected $table = 'projects_reports';

    //
    public function Project() {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($id, $ar_name, $en_name, $active, $file) {
        $new = new ProjectReport();
        $new->project_id = $id;
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
        $path = public_path('upload/projects/');
        $filename = $report->image;
        File::Delete($path . $filename);
        return $report->delete();
    }

}
