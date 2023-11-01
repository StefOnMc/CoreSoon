<?php

namespace Stef\Utils;

use Stef\Task\Broadcast;

class TaskUtils
{
public static function Register(){
Broadcast::Start();
}
}