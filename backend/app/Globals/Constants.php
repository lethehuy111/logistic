<?php

namespace App\Globals;

class Constants
{
    //Response
    const RESPONSE_SUCCESS = true;
    const RESPONSE_FAIL = false;

    // Role user
    const ROLE_CUSTOMER = 1;
    const ROLE_EMPLOYEE = 2 ;
    const ROLE_SHIPPER = 3;

    // Status
    const STATUS_ACTIVE = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_DONE = 3;
    const STATUS_REJECTED = 4;

    //Province_stocks
    const TYPE_STOCK = 1;
    const TYPE_PROVINCE = 2;

    // Order process
    const STATUS_PROCESS_OPEN = 1;
    const STATUS_PROCESS_PROCESSING = 0 ;
    const STATUS_PROCESS_DONE = 2 ;

    const TYPE_NORMAL_PROCESS = 1;
    const TYPE_END_PROCESS = 2 ;

    const EXPECTED_DATE = 2;

    const SHIPPING_FEE_DEFAULT = 20000;

}
