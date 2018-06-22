<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 15:33
 */

namespace data\model;

use think\Model;
use think\Db;
use think\Validate;
use think\Loader;

class BaseModel extends Model
{
    protected $table;

    /**
     * 单条查询的基本信息
     * @param string $condition 查询条件
     * @param string $field 查询字段
     * @param string $order 排序条件
     * @return array
     */
    public function getInfo($condition = '', $field = '*', $order = '')
    {
        $info = $this->where($condition)
            ->field($field)
            ->order($order)
            //->fetchSql(true)
            ->find();
        return $info;
    }

    /**
     * 获取数据总数
     * @param string|array $condition 查询条件
     * @return int|string
     */
    public function getCount($condition){
        $count = $this->where($condition)
            //->fetchSql(true)
            ->count();
        return $count;
    }

    /**
     * 获取一定条件下的列表
     * @param string $condition 查询条件
     * @param string $field 查询字段
     * @param string $order 排序条件
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getQuery($condition = '', $field = '*', $order = '')
    {
        $list = $this->field($field)
            ->where($condition)
            ->order($order)
            //->fetchSql(true)
            ->select();
        return $list;
    }

    /**
     * 获取一定条件下group的列表
     * @param string $condition
     * @param string string $field
     * @param string string $order
     * @param string $group_field
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getQueryGroupBy($condition = '', $field = '*', $order = '', $group_field = ''){
        $list = $this->field($field)
            ->where($condition)
            ->order($order)
            ->group($group_field)
            //->fetchSql(true)
            ->select();
        return $list;
    }

    /**
     * 分页列表查询
     * @param int $page_index 当前页
     * @param int $page_size 每页数据量
     * @param string $condition 查询条件
     * @param string $order 排序条件
     * @param string $field 查询字段
     * @return array
     */
    public function pageQuery($page_index, $page_size, $condition, $order = '', $field = '*')
    {
        $count = $this->where($condition)->count();
        if ($page_size == 0) {
            $list = $this->field($field)
                ->where($condition)
                ->order($order)
                ->select();
            $page_count = 1;
        } else {
            $start_row = $page_size * ($page_index - 1);
            $list = $this->field($field)
                ->where($condition)
                ->order($order)
                ->limit($start_row . "," . $page_size)
                ->select();
            if ($count % $page_size == 0) {
                $page_count = $count / $page_size;
            } else {
                $page_count = (int) ($count / $page_size) + 1;
            }
        }
        return array(
            'total_count' => $count,
            'page_count' => $page_count,
            'data' => $list,
        );
    }

    /**
     * 关联查询列表
     * @param object $viewObj 关联条件对象
     * @param int $page_index 当前页码
     * @param int $page_size 每页数量
     * @param string $condition 查询条件
     * @param string $order 排序条件
     * @param string $field 查询字段
     * @return mixed
     */
    public function viewPageQuery($viewObj, $page_index, $page_size, $condition, $order = '', $field = '*')
    {
        $count = $viewObj->where($condition)->count();
        if ($page_size == 0) {
            $list = $viewObj->field($field)
                ->where($condition)
                ->order($order)
                ->select();
            $page_count = 1;
        } else {
            $start_row = $page_size * ($page_index - 1);

            $list = $viewObj->field($field)
                ->where($condition)
                ->order($order)
                ->limit($start_row . "," . $page_size)
                ->select();
            if ($count % $page_size == 0) {
                $page_count = $count / $page_size;
            } else {
                $page_count = (int) ($count / $page_size) + 1;
            }
        }
        return array(
            'data' => $list,
            'total_count' => $count,
            'page_count' => $page_count
        );
    }

    /**
     * 查询条件数量
     * @param string $condition
     * @param string $field
     * @return number
     */
    public function getSum($condition, $field)
    {
        $sum = Db::table($this->table)->where($condition)->sum($field);
        if(empty($sum))
            return 0;
        else
            return $sum;
    }
    /**
     * 查询数据最大值
     * @param string $condition
     * @param string $field
     * @return number
     */
    public function getMax($condition, $field)
    {
        $max = Db::table($this->table)->where($condition)->max($field);
        if(empty($max))
            return 0;
        else
            return $max;
    }
    /**
     * 查询数据最小值
     * @param string $condition
     * @param string $field
     * @return number
     */
    public function getMin($condition, $field)
    {
        $min = Db::table($this->table)->where($condition)->min($field);
        if(empty($min))
            return 0;
        else
            return $min;
    }
    /**
     * 查询数据均值
     * @param string $condition
     * @param string $field
     * @return number
     */
    public function getAvg($condition, $field)
    {
        $avg = Db::table($this->table)->where($condition)->avg($field);
        if(empty($avg))
            return 0;
        else
            return $avg;
    }

    /**
     * 查询第一条数据
     * @param string $condition
     * @param string $order
     * @return mixed|string
     */
    public function getFirstData($condition, $order = '')
    {
        $data = Db::table($this->table)->where($condition)->order($order)->find();
        if(!empty($data))
            return $data;
        else
            return '';
    }

    /**
     * 删除一条记录
     * @param string $condition
     * @return int
     */
    public function delOne($condition = ''){
        if(!empty($condition)) {
            $result = $this->where($condition)
                //->fetchSql(true)
                ->delete();
            return $result;
        }
        return 0;
    }

    /**
     * 数据库开启事务
     */
    public function startTrans()
    {
        Db::startTrans();
    }

    /**
     * 数据库事务提交
     */
    public function commit()
    {
        Db::commit();
    }

    /**
     * 数据库事务回滚
     */
    public function rollback()
    {
        Db::rollback();
    }

}