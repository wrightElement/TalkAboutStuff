<?php

namespace App\Model;

enum CarStatusEnum: string
{
   case LEAD = 'leading';
   case INACTIVE = 'inactive';
   case REPAIR = 'repair';
   case NEW = 'new';
}
