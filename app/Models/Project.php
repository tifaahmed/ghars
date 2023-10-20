<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Project extends Model {

    protected $table = 'projects';

    public function Country() {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function Category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function Step() {
        return $this->hasOne(CategoryStep::class, 'id', 'step_id');
    }

    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Company() {
        return $this->hasOne(User::class, 'id', 'company_id');
    }

    public function Reports() {
        return $this->hasMany(ProjectReport::class, 'project_id', 'id');
    }

    public function Donations() {
        return $this->hasMany(Donation::class, 'rel_id', 'id')->where('category', 'projects')->where('active', '!=', 'unpaid');
    }

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->active = $data['active'];
        $this->company_id = $data['company_id'];
        $this->country_id = $data['country_id'];
        $this->category_id = $data['category_id'];
        $this->step_id = $data['step_id'];
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->ar_desc = $data['ar_desc'];
        $this->en_desc = $data['en_desc'];
        $this->amount = $data['amount'];
        $this->collect = $data['collect'];
        $this->type = $data['type'];
        if ($data['type'] == 'private') {
            $this->user_id = $data['user_id'];
        }
        if (isset($data['required'])) {
            $this->required = $data['required'];
        }
        $this->image = $file;
        $this->save();
        return $this->id;
    }

    public function edit($id, $data, $file = false) {
        $project = $this->find($id);
        $project->active = $data['active'];
        $project->company_id = $data['company_id'];
        $project->country_id = $data['country_id'];
        $project->category_id = $data['category_id'];
        $project->step_id = $data['step_id'];
        $project->start_date = $data['start_date'];
        $project->end_date = $data['end_date'];
        $project->en_name = $data['en_name'];
        $project->ar_name = $data['ar_name'];
        $project->ar_desc = $data['ar_desc'];
        $project->en_desc = $data['en_desc'];
        $project->amount = $data['amount'];
        $project->collect = $data['collect'];
        $project->type = $data['type'];
        if ($data['type'] == 'private') {
            $project->user_id = $data['user_id'];
        } else {
            $project->user_id = 0;
        }
        if (isset($data['required'])) {
            $project->required = $data['required'];
        }
        if ($file) {
            $path = public_path('upload/projects/');
            $filename = $project->image;
            File::Delete($path . $filename);
            $project->image = $file;
        }
        return $project->save();
    }

    public function edit_company($id, $data) {
        $project = $this->find($id);
        $project->step_id = $data['step_id'];
        $project->start_date = $data['start_date'];
        $project->end_date = $data['end_date'];
        $project->amount = $data['amount'];
        return $project->save();
    }

}
