<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum WhoWhatWhere: string
{
    // WHO
    case green = 'Green';
    case mustard = 'Mustard';
    case peacock = 'Peacock';
    case plum = 'Plum';
    case scarlett = 'Scarlett';
    case white = 'White';
    // WHAT
    case candlestick = 'Candlestick';
    case dagger = 'Dagger';
    case lead_pipe = 'Lead Pipe';
    case revolver = 'Revolver';
    case rope = 'Rope';
    case wrench = 'Wrench';
    // WHERE
    case ballroom = 'Ballroom';
    case billiard_room = 'Billiard Room';
    case conservatory = 'Conservatory';
    case dinning_room = 'Dinning Room';
    case hall = 'Hall';
    case kitchen = 'Kitchen';
    case library = 'Library';
    case lounge = 'Lounge';
    case study = 'Study';

    public function cardType(): string
    {
        return match ($this) {
            self::green, self::mustard, self::peacock, self::scarlett, self::white, self::plum => 'Who',
            self::candlestick, self::dagger, self::lead_pipe, self::revolver, self::rope, self::wrench => 'What',
            self::ballroom, self::billiard_room, self::conservatory, self::dinning_room, self::hall, self::kitchen, self::library, self::lounge, self::study => 'Where',
        };
    }

    public static function whoCards(bool $return_as_enum = false): Collection
    {
        return collect(self::cases())->filter(fn (self $item) => $item->cardType() === 'Who')->unless($return_as_enum, fn (Collection $items) => $items->map(fn (WhoWhatWhere $item) => $item->value));
    }

    public static function whatCards(bool $return_as_enum = false): Collection
    {
        return collect(self::cases())->filter(fn (self $item) => $item->cardType() === 'What')->unless($return_as_enum, fn (Collection $items) => $items->map(fn (WhoWhatWhere $item) => $item->value));
    }

    public static function whereCards(bool $return_as_enum = false): Collection
    {
        return collect(self::cases())->filter(fn (self $item) => $item->cardType() === 'Where')->unless($return_as_enum, fn (Collection $items) => $items->map(fn (WhoWhatWhere $item) => $item->value));
    }
}
