<?php

namespace Sco\Admin\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $guarded = ['created_at', 'updated_at'];

}
