<?php

namespace App\Utils\Globals;


class UserType
{
    const ADMIN = 'Admin';
    const VENDOR = 'Vendor';
	const EMPLOYEE = 'Employee';
	const CUSTOMER = 'Customer';


    public static $types = [
        self::ADMIN=>self::ADMIN,
        self::VENDOR=>self::VENDOR,
		self::EMPLOYEE=>self::EMPLOYEE,
		self::CUSTOMER=>self::CUSTOMER,	
    ];
}