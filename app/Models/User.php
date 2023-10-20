<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Config;

class User extends Authenticatable {

    use HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Group() {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function Country() {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function Categories() {
        return $this->hasMany(UserCategory::class, 'user_id', 'id');
    }

    public function Files() {
        return $this->hasMany(UserFile::class, 'user_id', 'id');
    }

    public function Portfolio() {
        return $this->hasMany(UserPortfolio::class, 'user_id', 'id');
    }

    public function Projects() {
        return $this->hasMany(Project::class, 'user_id', 'id');
    }

    public function Projectss() {
        return $this->hasMany(Project::class, 'company_id', 'id');
    }

    public function getList($type) {
        if ($type == 'company') {
            $lang = Config::get('app.locale');
            return $this->where('type', $type)->orderBy($lang . '_name', 'asc')->pluck($lang . '_name', 'id')->toArray();
        } else {
            return $this->where('type', $type)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }
    }

    public function getAll($type) {
        return $this->where('type', $type)->where('active', '!=', 'delete')->get();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function add($data) {
        $this->country_id = $data['country_id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->whatsapp = $data['whatsapp'];
        $this->type = $data['type'];
        $this->password = Hash::make($data['password']);
        if (isset($data['group_id'])) {
            $this->group_id = $data['group_id'];
        }
        if (isset($data['governate'])) {
            $this->governate = $data['governate'];
        }
        if (isset($data['city'])) {
            $this->city = $data['city'];
        }
        if (isset($data['street'])) {
            $this->street = $data['street'];
        }
        if (isset($data['ar_name'])) {
            $this->ar_name = $data['ar_name'];
        }
        if (isset($data['en_name'])) {
            $this->en_name = $data['en_name'];
        }
        $this->save();
        return $this->id;
    }

    public function edit($id, $data) {
        $user = $this->find($id);
        $user->country_id = $data['country_id'];
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        $user->whatsapp = $data['whatsapp'];
        if ($data['password'] != "") {
            $user->password = Hash::make($data['password']);
        }
        if (isset($data['group_id'])) {
            $user->group_id = $data['group_id'];
        }
        if (isset($data['active'])) {
            $user->active = $data['active'];
        }
        if (isset($data['governate'])) {
            $user->governate = $data['governate'];
        }
        if (isset($data['city'])) {
            $user->city = $data['city'];
        }
        if (isset($data['street'])) {
            $user->street = $data['street'];
        }
        if (isset($data['ar_name'])) {
            $user->ar_name = $data['ar_name'];
        }
        if (isset($data['en_name'])) {
            $user->en_name = $data['en_name'];
        }
        return $user->save();
    }

    public function remove($id) {
        $user = $this->find($id);
        $user->active = 'delete';
        $user->deleted_at = now();
        return $user->save();
    }

}
