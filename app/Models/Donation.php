<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model {

    protected $table = 'donations';

    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Visitor() {
        return $this->hasOne(Visitor::class, 'id', 'user_id');
    }

    public function Gift() {
        return $this->hasOne(Gift::class, 'id', 'gift_id');
    }

    public function Child() {
        return $this->hasOne(Child::class, 'id', 'rel_id');
    }

    public function Family() {
        return $this->hasOne(Family::class, 'id', 'rel_id');
    }

    public function Project() {
        return $this->hasOne(Project::class, 'id', 'rel_id');
    }

    public function Teacher() {
        return $this->hasOne(Teacher::class, 'id', 'rel_id');
    }

    public function getAll() {
        return $this->where('active','!=','unpaid')->get();
    }

    public function edit($id, $active) {
        $donation = $this->find($id);
        $donation->active = $active;
        return $donation->save();
    }

}
