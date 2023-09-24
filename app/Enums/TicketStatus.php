<?php
namespace App\Enums;

enum  TicketStatus :string {
    case OPEN = 'Open';
    case ACCEPTED = 'Accept';
    case REJECTED = 'Reject';
}
?>