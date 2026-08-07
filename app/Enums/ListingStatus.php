<?php

namespace App\Enums;

enum ListingStatus: string
{
    case Draft = 'draft';
    case Live = 'live';
    case UnderOffer = 'under_offer';
    case Sold = 'sold';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Live => 'Live',
            self::UnderOffer => 'Under offer',
            self::Sold => 'Sold',
        };
    }
}
