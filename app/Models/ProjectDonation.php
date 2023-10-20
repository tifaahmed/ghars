<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDonation extends Model {

    protected $table = 'projects_donations';

    //
    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Visitor() {
        return $this->hasOne(Visitor::class, 'id', 'user_id');
    }

    public function Project() {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

}
