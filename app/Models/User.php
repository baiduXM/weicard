<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends CommonModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

//    const IS_ADMIN = 1; // 管理员

    /**
     * @var array
     */
    protected $guarded = [
        'id', 'password_confirmation', 'oauth_weixin',
    ];

    /**
     * 在数组中隐藏的属性
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 关系模型(一对一) - 公司
     */
    public function company()
    {
        return $this->hasOne('App\Models\Company');
    }

    /**
     * 关系模型(一对一) - 员工
     */
    public function employee()
    {
        return $this->hasOne('App\Models\Employee');
    }

    /**
     * 关系模型(一对多) - 分组
     */
    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }

    /**
     * 关系模型(一对多) - 名片夹
     */
    public function cardcases()
    {
        return $this->hasMany('App\Models\Cardcase');
    }

//    /**
//     * 关系模型(多对多) - 名片群
//     */
//    public function circles()
//    {
//        return $this->belongsToMany('App\Models\Group', 'group_user');
//    }

//    /**
//     * 关系模型(一对多) - 标签
//     */
//    public function tags()
//    {
//        return $this->hasMany('App\Models\Tag');
//    }

    /**
     * 关系模型(一对多,多态) - 被谁关注
     */
    public function followers()
    {
        return $this->morphMany('App\Models\Cardcase', 'follower');
    }

    /**
     * 关系模型(多对多,多态) - 模板
     */
    public function templates()
    {
        return $this->morphToMany('App\Models\Template', 'useable', 'template_useable');
    }


    /**
     * 用户绑定员工
     *
     * @param $code 绑定代码
     * @param $id   用户ID
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function binding($code, $id)
    {

//        $code = explode('/', $code);
//        $count = count($code);
//        if ($count != 2) {
//            return 101; // 绑定失败 - 代码无效
//        }
        $user = User::with('company', 'employee')->find($id);
        if ($user->employee) {
            return 109;
        }
//        $company = Company::where('mobile', $code)->first();
//        if (!$company) {
//            return 102; // 绑定失败 - 找不到公司信息
//        }
        $employee = Employee::where('mobile',  $code)->first();
        if (!$employee) {
            return 103; // 绑定失败 - 找不到员工信息
        }
        if ($employee->user_id) {
            return 104; // 绑定失败 - 员工已绑定用户
        }
//        if (!$company->user_id) { // 公司无创始人
//            $user->company()->save($company); // 绑定公司
//        }
        $user->employee()->save($employee); // 绑定员工
        return 100;
    }

    /**
     * 用户解绑公司-员工
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unbinding($id)
    {
        $user = User::with('company', 'employee')->find($id);
        if (!$user->employee) {
            return 202;
        } else {
            $user->employee->user_id = null;
            $user->employee->save();
        }
        if ($user->company) {
            $user->company->user_id = null;
            $user->company->save();
        }
        return 200;
    }

}
