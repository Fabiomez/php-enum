<?php

namespace Tests;

use Fabiomez\Enum\Enum;

/**
 * @method static self CONST_1
 * @method static self CONST_2
 * @method static self CONST_3
 */
class EnumSample1 extends Enum
{
    const CONST_1 = 'S1';
    const CONST_2 = 12;
    const CONST_3 = 1.3;
}
