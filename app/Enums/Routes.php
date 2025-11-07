<?php

namespace App\Enums;

enum Routes: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case CONTRACT = 'contract';
    case PAYMENT = 'payment';
    case PRICE = 'price';
    case SERVICE = 'service';
    case TEMPLATE = 'template';
    case USER = 'user';
    case LOG = 'log';
    case DOMAIN = 'domain';
    case HOSTING = 'hosting';
}
