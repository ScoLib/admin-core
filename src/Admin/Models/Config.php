<?php


namespace Sco\Admin\Models;

use Cache;
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

    private static $configs = null;

    /**
     * 获取配置
     *
     * @return array
     */
    public static function getConfigs()
    {
        if (self::$configs) {
            return self::$configs;
        }

        self::$configs = Cache::rememberForever('configs_list', function () {
            $collection = collect();
            self::all()->each(function ($item) use ($collection) {
                $collection->put($item->name, $item->value);
            });
            return $collection->all();
        });

        return self::$configs;

    }

    /**
     * 保存配置
     *
     * @param array $configs 配置
     *
     * @return boolean
     */
    public function saveConfigs($configs)
    {
        foreach ($configs as $name => $value) {
            $model = $this->findOrFail($name);
            $model->value = $value;
            $model->save();
        }
        Cache::forget('configs');
        //$this->flushConfigFile();
        return true;
    }

    public static function value($name)
    {
        $configs = self::getConfigs();
        return isset($configs[$name]) ? $configs[$name] : '';
    }

}