<?php

namespace App\Model;

enum ThingStatusEnum: string
{
   case ACTIVE = 'Active';
   case INACTIVE = 'Inactive';
   case RETIRED = 'Retired';
   case NEW = 'New';
   case DAMAGED = 'Damaged';
   case LOST = 'Lost';
   case DESTROYED = 'Destroyed';
}
