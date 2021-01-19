<?php
namespace App\Utils\Globals;

/**
 * 
 */
class VendorStatus 
{
	
	const PENDING = 'Pending';
    const VERIFYING = 'Verifying';
	const REJECTED = 'Rejected';
	const ACTIVE = 'Active';


	public static $types = [
		self::PENDING=>self::PENDING,	
		self::VERIFYING=>self::VERIFYING,	
        self::REJECTED=>self::REJECTED,
        self::ACTIVE=>self::ACTIVE,
    ];
}