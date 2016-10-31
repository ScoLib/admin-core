<?php

namespace Sco\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $guarded = ['created_at', 'updated_at'];

}
