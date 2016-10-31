<?php


namespace Sco\Models;


use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    // 主键
    protected $primaryKey = 'name';

    // 不使用时间戳
    public $timestamps = false;

    //
    public $incrementing = false;

    protected $fillable = ['name', 'value'];

}