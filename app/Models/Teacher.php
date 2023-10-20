<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Teacher extends Model {

    protected $table = 'teachers';

    public function Country() {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function ResponsibleCountry() {
        return $this->hasOne(Country::class, 'id', 'responsible_country_id');
    }

    public function Videos() {
        return $this->hasMany(TeacherVideo::class, 'teacher_id', 'id');
    }

    public function Reports() {
        return $this->hasMany(TeacherReport::class, 'teacher_id', 'id');
    }

    public function Donations() {
        return $this->hasMany(Donation::class, 'rel_id', 'id')->where('category', 'teachers')->where('active', '!=', 'unpaid');
    }

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data, $file) {
        $this->active = $data['active'];
        $this->required = $data['required'];
        $this->country_id = $data['country_id'];
        $this->gender = $data['gender'];
        $this->ar_name = $data['ar_name'];
        $this->en_name = $data['en_name'];
        $this->ar_nationality = $data['ar_nationality'];
        $this->en_nationality = $data['en_nationality'];
        $this->birth_date = $data['birth_date'];
        $this->ar_address = $data['ar_address'];
        $this->en_address = $data['en_address'];
        $this->ar_status = $data['ar_status'];
        $this->en_status = $data['en_status'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->ar_qualification = $data['ar_qualification'];
        $this->en_qualification = $data['en_qualification'];
        $this->ar_qualification_source = $data['ar_qualification_source'];
        $this->en_qualification_source = $data['en_qualification_source'];
        $this->qualification_date = $data['qualification_date'];
        $this->ar_specialization = $data['ar_specialization'];
        $this->en_specialization = $data['en_specialization'];
        $this->ar_career = $data['ar_career'];
        $this->en_career = $data['en_career'];
        $this->ar_invitation = $data['ar_invitation'];
        $this->en_invitation = $data['en_invitation'];
        $this->ar_social = $data['ar_social'];
        $this->en_social = $data['en_social'];
        $this->ar_quran = $data['ar_quran'];
        $this->en_quran = $data['en_quran'];
        $this->ar_skills = $data['ar_skills'];
        $this->en_skills = $data['en_skills'];
        $this->responsible_country_id = $data['responsible_country_id'];
        $this->ar_responsible_address = $data['ar_responsible_address'];
        $this->en_responsible_address = $data['en_responsible_address'];
        $this->responsible_email = $data['responsible_email'];
        $this->responsible_phone = $data['responsible_phone'];
        $this->ar_responsible = $data['ar_responsible'];
        $this->en_responsible = $data['en_responsible'];
        $this->amount = $data['amount'];
        $this->image = $file;
        $this->save();
        return $this->id;
    }

    public function edit($id, $data, $file = false) {
        $teacher = $this->find($id);
        $teacher->active = $data['active'];
        $teacher->required = $data['required'];
        $teacher->country_id = $data['country_id'];
        $teacher->gender = $data['gender'];
        $teacher->ar_name = $data['ar_name'];
        $teacher->en_name = $data['en_name'];
        $teacher->ar_nationality = $data['ar_nationality'];
        $teacher->en_nationality = $data['en_nationality'];
        $teacher->birth_date = $data['birth_date'];
        $teacher->ar_address = $data['ar_address'];
        $teacher->en_address = $data['en_address'];
        $teacher->ar_status = $data['ar_status'];
        $teacher->en_status = $data['en_status'];
        $teacher->phone = $data['phone'];
        $teacher->email = $data['email'];
        $teacher->ar_qualification = $data['ar_qualification'];
        $teacher->en_qualification = $data['en_qualification'];
        $teacher->ar_qualification_source = $data['ar_qualification_source'];
        $teacher->en_qualification_source = $data['en_qualification_source'];
        $teacher->qualification_date = $data['qualification_date'];
        $teacher->ar_specialization = $data['ar_specialization'];
        $teacher->en_specialization = $data['en_specialization'];
        $teacher->ar_career = $data['ar_career'];
        $teacher->en_career = $data['en_career'];
        $teacher->ar_invitation = $data['ar_invitation'];
        $teacher->en_invitation = $data['en_invitation'];
        $teacher->ar_social = $data['ar_social'];
        $teacher->en_social = $data['en_social'];
        $teacher->ar_quran = $data['ar_quran'];
        $teacher->en_quran = $data['en_quran'];
        $teacher->ar_skills = $data['ar_skills'];
        $teacher->en_skills = $data['en_skills'];
        $teacher->responsible_country_id = $data['responsible_country_id'];
        $teacher->ar_responsible_address = $data['ar_responsible_address'];
        $teacher->en_responsible_address = $data['en_responsible_address'];
        $teacher->responsible_email = $data['responsible_email'];
        $teacher->responsible_phone = $data['responsible_phone'];
        $teacher->ar_responsible = $data['ar_responsible'];
        $teacher->en_responsible = $data['en_responsible'];
        $teacher->amount = $data['amount'];
        if ($file) {
            $path = public_path('upload/teachers/');
            $filename = $teacher->image;
            File::Delete($path . $filename);
            $teacher->image = $file;
        }
        return $teacher->save();
    }

}
