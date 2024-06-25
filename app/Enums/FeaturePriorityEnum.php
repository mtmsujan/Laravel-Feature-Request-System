<?php 
namespace App\Enums;

enum FeaturePriorityEnum:string {
    case NICE_TO_HAVE = 'nice to have';
    case IMPORTANT = 'important';
    case CRITICAL = 'critical';
}

?>