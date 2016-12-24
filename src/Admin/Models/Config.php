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

    private $configs = null;

    /**
     * 获取配置
     *
     * @return array
     */
    public function getConfigs()
    {
        if ($this->configs) {
            return $this->configs;
        }

        $this->configs = Cache::rememberForever('configs', function () {
            $collection = collect();
            $this->all()->each(function ($item) use ($collection) {
                $collection->put($item->name, $item->value);
            });
            return $collection->all();
        });

        return $this->configs;

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

    /**
     * 刷新配置缓存文件
     */
    private function flushConfigFile()
    {
        $configs = $this->getConfigs();
        $file    = config_path('sco.php');
        file_put_contents($file, sprintf('<?php return %s;', var_export($configs, true)));
    }

}