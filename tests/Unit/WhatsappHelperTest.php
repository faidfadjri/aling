<?php

namespace Tests\Feature;

use App\Helper\WhatsappHelper;
use Tests\TestCase;

class WhatsappHelperTest extends TestCase
{
    /** @test */
    public function it_formats_number_starting_with_0()
    {
        $this->assertEquals(
            'https://wa.me/628123456789',
            WhatsappHelper::formatWaLink('08123456789')
        );
    }

    /** @test */
    public function it_formats_number_starting_with_plus_62()
    {
        $this->assertEquals(
            'https://wa.me/628123456789',
            WhatsappHelper::formatWaLink('+628123456789')
        );
    }

    /** @test */
    public function it_formats_number_starting_with_62()
    {
        $this->assertEquals(
            'https://wa.me/628123456789',
            WhatsappHelper::formatWaLink('628123456789')
        );
    }

    /** @test */
    public function it_removes_spaces_and_dashes()
    {
        $this->assertEquals(
            'https://wa.me/628123456789',
            WhatsappHelper::formatWaLink('0812-3456 789')
        );
    }

    /** @test */
    public function it_formats_number_with_unexpected_prefix()
    {
        $this->assertEquals(
            'https://wa.me/62123456789',
            WhatsappHelper::formatWaLink('123456789')
        );
    }
}
