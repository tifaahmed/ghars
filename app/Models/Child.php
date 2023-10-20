<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Child extends Model {

    protected $table = 'childern';

    public function Country() {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function Reports() {
        return $this->hasMany(ChildReport::class, 'child_id', 'id');
    }

    public function Donations() {
        return $this->hasMany(Donation::class, 'rel_id', 'id')->where('category', 'childern')->where('active', '!=', 'unpaid');
    }

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file, $filee = false) {
        $this->active = $data['active'];
        $this->required = $data['required'];
        $this->country_id = $data['country_id'];
        $this->gender = $data['gender'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->birth_date = $data['birth_date'];
        $this->birth_no = $data['birth_no'];
        $this->ar_nationality = $data['ar_nationality'];
        $this->en_nationality = $data['en_nationality'];
        $this->ar_governate = $data['ar_governate'];
        $this->en_governate = $data['en_governate'];
        $this->ar_city = $data['ar_city'];
        $this->en_city = $data['en_city'];
        $this->ar_study_stage = $data['ar_study_stage'];
        $this->en_study_stage = $data['en_study_stage'];
        $this->ar_class = $data['ar_class'];
        $this->en_class = $data['en_class'];
        $this->ar_quran = $data['ar_quran'];
        $this->en_quran = $data['en_quran'];
        $this->ar_skills = $data['ar_skills'];
        $this->en_skills = $data['en_skills'];
        $this->ar_psychological = $data['ar_psychological'];
        $this->en_psychological = $data['en_psychological'];
        $this->ar_illness = $data['ar_illness'];
        $this->en_illness = $data['en_illness'];
        $this->ar_healthy = $data['ar_healthy'];
        $this->en_healthy = $data['en_healthy'];
        $this->ar_illness_desc = $data['ar_illness_desc'];
        $this->en_illness_desc = $data['en_illness_desc'];
        $this->death_date = $data['death_date'];
        $this->ar_death_reason = $data['ar_death_reason'];
        $this->en_death_reason = $data['en_death_reason'];
        $this->ar_responsible = $data['ar_responsible'];
        $this->en_responsible = $data['en_responsible'];
        $this->ar_relative = $data['ar_relative'];
        $this->en_relative = $data['en_relative'];
        $this->brothers = $data['brothers'];
        $this->sisters = $data['sisters'];
        $this->amount = $data['amount'];
        $this->image = $file;
        if ($filee) {
            $this->study_report = $filee;
        }
        $this->save();
        return $this->id;
    }

    public function edit($id, $data, $file = false, $filee = false) {
        $child = $this->find($id);
        $child->active = $data['active'];
        $child->required = $data['required'];
        $child->country_id = $data['country_id'];
        $child->gender = $data['gender'];
        $child->ar_name = $data['ar_name'];
        $child->en_name = $data['en_name'];
        $child->birth_date = $data['birth_date'];
        $child->birth_no = $data['birth_no'];
        $child->ar_nationality = $data['ar_nationality'];
        $child->en_nationality = $data['en_nationality'];
        $child->ar_governate = $data['ar_governate'];
        $child->en_governate = $data['en_governate'];
        $child->ar_city = $data['ar_city'];
        $child->en_city = $data['en_city'];
        $child->ar_study_stage = $data['ar_study_stage'];
        $child->en_study_stage = $data['en_study_stage'];
        $child->ar_class = $data['ar_class'];
        $child->en_class = $data['en_class'];
        $child->ar_quran = $data['ar_quran'];
        $child->en_quran = $data['en_quran'];
        $child->ar_skills = $data['ar_skills'];
        $child->en_skills = $data['en_skills'];
        $child->ar_psychological = $data['ar_psychological'];
        $child->en_psychological = $data['en_psychological'];
        $child->ar_illness = $data['ar_illness'];
        $child->en_illness = $data['en_illness'];
        $child->ar_healthy = $data['ar_healthy'];
        $child->en_healthy = $data['en_healthy'];
        $child->ar_illness_desc = $data['ar_illness_desc'];
        $child->en_illness_desc = $data['en_illness_desc'];
        $child->death_date = $data['death_date'];
        $child->ar_death_reason = $data['ar_death_reason'];
        $child->en_death_reason = $data['en_death_reason'];
        $child->ar_responsible = $data['ar_responsible'];
        $child->en_responsible = $data['en_responsible'];
        $child->ar_relative = $data['ar_relative'];
        $child->en_relative = $data['en_relative'];
        $child->brothers = $data['brothers'];
        $child->sisters = $data['sisters'];
        $child->amount = $data['amount'];
        if ($file) {
            $path = public_path('upload/childern/');
            $filename = $child->image;
            File::Delete($path . $filename);
            $child->image = $file;
        }
        if ($filee) {
            $path = public_path('upload/childern/');
            $filename = $child->study_report;
            File::Delete($path . $filename);
            $child->study_report = $filee;
        }
        return $child->save();
    }

}
