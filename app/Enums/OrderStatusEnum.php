<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case ABERTO = 'aberto';
    case APROVADO = 'aprovado';
    case CONCLUIDO = 'concluido';
    case CANCELADO = 'cancelado';
}
