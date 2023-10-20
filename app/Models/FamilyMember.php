<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class FamilyMember extends Model {

    protected $table = 'families_members';

    //
    public function Family() {
        return $this->hasOne(Family::class, 'id', 'family_id');
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->active = $data['active'];
        $this->family_id = $data['family_id'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->birth_date = $data['birth_date'];
        $this->gender = $data['gender'];
        $this->ar_civil_type = $data['ar_civil_type'];
        $this->en_civil_type = $data['en_civil_type'];
        $this->civil_id = $data['civil_id'];
        $this->ar_career_status = $data['ar_career_status'];
        $this->en_career_status = $data['en_career_status'];
        $this->ar_class = $data['ar_class'];
        $this->en_class = $data['en_class'];
        $this->ar_healthy = $data['ar_healthy'];
        $this->en_healthy = $data['en_healthy'];
        $this->ar_psychological = $data['ar_psychological'];
        $this->en_psychological = $data['en_psychological'];
        $this->image = $file;
        return $this->save();
    }

    public function edit($id, $data, $file = false) {
        $member = $this->find($id);
        $member->active = $data['active'];
        $member->ar_name = $data['ar_name'];
        $member->en_name = $data['en_name'];
        $member->birth_date = $data['birth_date'];
        $member->gender = $data['gender'];
        $member->ar_civil_type = $data['ar_civil_type'];
        $member->en_civil_type = $data['en_civil_type'];
        $member->civil_id = $data['civil_id'];
        $member->ar_career_status = $data['ar_career_status'];
        $member->en_career_status = $data['en_career_status'];
        $member->ar_class = $data['ar_class'];
        $member->en_class = $data['en_class'];
        $member->ar_healthy = $data['ar_healthy'];
        $member->en_healthy = $data['en_healthy'];
        $member->ar_psychological = $data['ar_psychological'];
        $member->en_psychological = $data['en_psychological'];
        if ($file) {
            $path = public_path('upload/families_members/');
            $filename = $member->image;
            File::Delete($path . $filename);
            $member->image = $file;
        }
        return $member->save();
    }

    public function remove($id) {
        $report = $this->find($id);
        $path = public_path('upload/families_members/');
        $filename = $report->image;
        File::Delete($path . $filename);
        return $report->delete();
    }

}
