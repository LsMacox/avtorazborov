<?php

namespace App\Models;


use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Cookie;
use Cache;

// Models
use App\Models\UserSettings\ShopSetting;
use App\Models\UserSettings\UserSetting;
use App\Models\UserSettings\AdminSetting;
use App\Models\Media;
use App\Models\Role;
use App\Models\ShopTransportInStock;
use App\Models\Alert\ShopProfileAlert;
use App\Models\Alert\ShopProfileAlertRegion;
use App\Models\Alert\ShopProfileAlertSynonym;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function user_setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function shop_setting()
    {
        return $this->hasOne(ShopSetting::class);
    }

    public function shop_transport_in_stocks()
    {
        return $this->hasMany(ShopTransportInStock::class);
    }

    public function admin_setting()
    {
        return $this->hasOne(AdminSetting::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function shop_profile_alert()
    {
        return $this->hasOne(ShopProfileAlert::class);
    }

    public function shop_profile_alert_regions()
    {
        return $this->hasMany(ShopProfileAlertRegion::class);
    }

    public function shop_profile_alert_synonyms()
    {
        return $this->hasMany(ShopProfileAlertSynonym::class);
    }


    # Scopes

    public function scopeAuth($query)
    {
        return $query->where('id', auth()->id());
    }


    # Roles

    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }
    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn("name", $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return $this->getRole() == $role;
    }

    /**
     * Get role
     * @param string $role
     */
    public function getRole()
    {
        return auth()->user()->roles()->first()->name;
    }


    // Additional

    /**
     * @param $bool
     */
    public function isAlert($bool)
    {
        if ($bool){
            Cache::put('is_alert', 'true', Carbon::now()->addDays(15));
        }else{
            Cache::pull('is_alert');
        }
    }

    public function isPolicy()
    {
        Cookie::queue('policy', true, Carbon::now()->addYears(5)->diffInMinutes(now()), '/cabinet');
    }

    public function checkCompletedProfileAboutShop()
    {
        $userSettings = auth()->user()->shop_setting;

        if (empty($userSettings->name)
            || empty($userSettings->email)
            || empty($userSettings->phone)
            || empty($userSettings->address)
            || empty($userSettings->city)
            || empty($userSettings->description)
            || empty($userSettings->schedule))
        {
            return false;
        }

        return true;
    }

}
