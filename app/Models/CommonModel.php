<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommonModel extends Model
{

    const IS_ACTIVE = 1; // 激活
    const IS_ACTIVE_NOT = 0; // 停用
    const SEX_UNKNOWN = 0; // 未知
    const SEX_MALE = 1; // 男
    const SEX_FEMALE = 2; // 女
    const IS_DELETED = 1; // 已删除

    /**
     * 判断是否可用
     *
     * @param null $index
     * @return array|mixed
     */
    public function isActive($index = null)
    {
        $array = [
            self::IS_ACTIVE     => '激活',
            self::IS_ACTIVE_NOT => '停用',
        ];
        if ($index !== null) {
            return array_key_exists($index, $array) ? $array[$index] : reset($array);
        }
        return $array;
    }

    /**
     * 判断是否软删除
     *
     * @param null $index
     * @return string
     */
    public function isDelete($index = null)
    {
        $array = [
            self::IS_DELETED => '已删除',
        ];
        if ($index !== null) {
            return array_key_exists($index, $array) ? $array[$index] : reset($array);
        }
        return $array;
    }

    /**
     * 获取性别
     *
     * @param $index
     * @return array|mixed
     */
    public function getSex($index = null)
    {
        $array = [
            self::SEX_UNKNOWN => '未知',
            self::SEX_MALE    => '男',
            self::SEX_FEMALE  => '女',
        ];
        if ($index !== null) {
            return array_key_exists($index, $array) ? $array[$index] : reset($array);
        }
        return $array;
    }

    /**
     * 获取对外职位（根据部门-职位）
     *
     * @param $department 部门名称
     * @param $position   职位名称
     * @return string 对外职位名称
     */
    public function getPositionForOut($department, $position)
    {
        if ($department && $position) {
            $res = DB::table('dp2out')->where('department', $department)->where('position', $position)->first();
            return (isset($res->external) && !empty($res->external)) ? $res->external : $position;
        }
    }

//    public function updatePosition($)

}
