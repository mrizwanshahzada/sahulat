<?php
namespace App\Utils\Globals;

/**
 * 
 */
class ServiceStatus 
{
	
	const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';


	public static $types = [
		self::ACTIVE=>self::ACTIVE,	
		self::INACTIVE=>self::INACTIVE,
    ];
}