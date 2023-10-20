<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Family extends Model {

    protected $table = 'families';

    public function Country() {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function Members() {
        return $this->hasMany(FamilyMember::class, 'family_id', 'id');
    }

    public function Reports() {
        return $this->hasMany(FamilyReport::class, 'family_id', 'id');
    }

    public function Donations() {
        return $this->hasMany(Donation::class, 'rel_id', 'id')->where('category', 'families')->where('active', '!=', 'unpaid');
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
        $this->civil_id = $data['civil_id'];
        $this->ar_parent_status = $data['ar_parent_status'];
        $this->en_parent_status = $data['en_parent_status'];
        $this->death_date = $data['death_date'];
        $this->ar_death_reason = $data['ar_death_reason'];
        $this->en_death_reason = $data['en_death_reason'];
        $this->members_count = $data['members_count'];
        $this->males = $data['males'];
        $this->females = $data['females'];
        $this->ar_responsible = $data['ar_responsible'];
        $this->en_responsible = $data['en_responsible'];
        $this->ar_relative = $data['ar_relative'];
        $this->en_relative = $data['en_relative'];
        $this->ar_career = $data['ar_career'];
        $this->en_career = $data['en_career'];
        $this->ar_career_status = $data['ar_career_status'];
        $this->en_career_status = $data['en_career_status'];
        $this->responsible_civil_id = $data['responsible_civil_id'];
        $this->amount = $data['amount'];
        $this->image = $file;
        $this->save();
        return $this->id;
    }

    public function edit($id, $data, $file = false) {
        $family = $this->find($id);
        $family->active = $data['active'];
        $family->required = $data['required'];
        $family->country_id = $data['country_id'];
        $family->gender = $data['gender'];
        $family->ar_name = $data['ar_name'];
        $family->en_name = $data['en_name'];
        $family->ar_nationality = $data['ar_nationality'];
        $family->en_nationality = $data['en_nationality'];
        $family->civil_id = $data['civil_id'];
        $family->ar_parent_status = $data['ar_parent_status'];
        $family->en_parent_status = $data['en_parent_status'];
        $family->death_date = $data['death_date'];
        $family->ar_death_reason = $data['ar_death_reason'];
        $family->en_death_reason = $data['en_death_reason'];
        $family->members_count = $data['members_count'];
        $family->males = $data['males'];
        $family->females = $data['females'];
        $family->ar_responsible = $data['ar_responsible'];
        $family->en_responsible = $data['en_responsible'];
        $family->ar_relative = $data['ar_relative'];
        $family->en_relative = $data['en_relative'];
        $family->ar_career = $data['ar_career'];
        $family->en_career = $data['en_career'];
        $family->ar_career_status = $data['ar_career_status'];
        $family->en_career_status = $data['en_career_status'];
        $family->responsible_civil_id = $data['responsible_civil_id'];
        $family->amount = $data['amount'];
        if ($file) {
            $path = public_path('upload/families/');
            $filename = $family->image;
            File::Delete($path . $filename);
            $family->image = $file;
        }
        return $family->save();
    }

}
