<?php 
namespace App\Enums;

enum FeatureStatusEnum:string {
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in progress';
    case REQUESTED = 'request';
}

?>