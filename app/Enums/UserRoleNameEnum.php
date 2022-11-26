<?php

namespace App\Enums;

enum UserRoleNameEnum:string {
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Author = 'author';
    case Viewer = 'viewer';
    case PaidUser = 'paid_user';
}
