<?php

namespace Tests\Unit;

use App\Enums\WhoWhatWhere;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class EnumWhoWhatWhereTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_whoWhatWhere_enum_who_cards(): void
    {
        $who_cards = WhoWhatWhere::whoCards();

        $this->assertInstanceOf(Collection::class, $who_cards);

        WhoWhatWhere::whoCards(true)->each(function (WhoWhatWhere $whoCard) {
            $this->assertTrue($whoCard->cardType() === 'Who');
        });
    }

    public function test_whoWhatWhere_enum_what_cards(): void
    {
        $what_cards = WhoWhatWhere::whatCards();

        $this->assertInstanceOf(Collection::class, $what_cards);

        WhoWhatWhere::whatCards(true)->each(function (WhoWhatWhere $whoCard) {
            $this->assertTrue($whoCard->cardType() === 'What');
        });
    }

    public function test_whoWhatWhere_enum_where_cards(): void
    {
        $where_cards = WhoWhatWhere::whereCards();

        $this->assertInstanceOf(Collection::class, $where_cards);

        WhoWhatWhere::whereCards(true)->each(function (WhoWhatWhere $whoCard) {
            $this->assertTrue($whoCard->cardType() === 'Where');
        });
    }
}
