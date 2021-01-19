<?php
namespace App\Utils\Globals;

/**
 * 
 */
class TaskStatus 
{
	
	const ASSIGNED = 'Assigned';
    const COMPLETED = 'Completed';
	const CANCELED = 'Canceled';
	const PENDING = 'Pending';
	const INPROGRESS = 'In Progress';
	const VERIFYING = 'Verifying';
	const UPDATE = 'Update';


	public static $types = [
        self::ASSIGNED=>self::ASSIGNED,
        self::COMPLETED=>self::COMPLETED,
		self::CANCELED=>self::CANCELED,
		self::PENDING=>self::PENDING,	
		self::INPROGRESS=>self::INPROGRESS,
		self::VERIFYING=>self::VERIFYING,	
		self::UPDATE=>self::UPDATE,	
    ];
}