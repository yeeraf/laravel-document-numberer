<?php

namespace Tests\Feature\DocumentNumberer;

use Carbon\Carbon;

use Illuminate\Foundation\Testing\RefreshDatabase;;

use Yeeraf\DocumentNumberer\Tests\TestCase;
use Yeeraf\DocumentNumberer\DocumentNumberer;
use Yeeraf\DocumentNumberer\Models\DocumentNumber;

class DocumentNumbererTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_generate_document_number()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumber = new DocumentNumberer();

        $this->assertEquals("2101000001", $documentNumber->generate());
    }

    /** @test */
    public function it_can_set_name_to_support_same_number_but_different_document_type()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumber = new DocumentNumberer();

        $this->assertEquals("2101000001", $documentNumber->name("invoice")->generate());
        $this->assertEquals("2101000001", $documentNumber->name("receipt")->generate());
    }


    /** @test */
    public function it_can_set_prefix()
    {
        $documentNumber = new DocumentNumberer();

        $this->assertEquals("INV-000001", $documentNumber->prefix("INV-")->generate());
    }

    /** @test */
    public function it_can_set_suffix()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumber = new DocumentNumberer();

        $this->assertEquals("2101000001-X", $documentNumber->suffix("-X")->generate());
    }

    /** @test */
    public function it_can_set_pad_string()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumber = new DocumentNumberer();

        $this->assertEquals("2101XXXXX1", $documentNumber->padString("X")->generate());
    }

    /** @test */
    public function it_can_set_pad_length()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumber = new DocumentNumberer();

        $this->assertEquals("210101", $documentNumber->padLength(2)->generate());
    }

    /** @test */
    public function it_can_set_pad_type()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumber = new DocumentNumberer();

        $this->assertEquals("2101100000", $documentNumber->padType('right')->generate());
    }


    /** @test */
    public function it_can_set_with_multiple_options()
    {
        $documentNumber = new DocumentNumberer();

        $this->assertEquals(
            "INV-___1-X",
            $documentNumber
                ->prefix("INV-")
                ->suffix("-X")
                ->padType('left')
                ->padString('_')
                ->padLength('4')
                ->teamId(true)
                ->generate()
        );
    }

    /** @test */
    public function it_can_extend_running_number_on_over_pad_length()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumberer = new DocumentNumberer();
        $documentNumberer->generate();

        // create document number record
        $dn = DocumentNumber::first();
        $dn->current_number = 999999;
        $dn->save();

        $this->assertEquals("21011000000", $documentNumberer->generate());
    }


    /** @test */
    public function it_can_be_set_to_prevent_auto_extend_running_number()
    {
        $documentNumber = new DocumentNumberer();

        $this->assertEquals(
            "INV-___1-X",
            $documentNumber
                ->prefix("INV-")
                ->suffix("-X")
                ->padType('left')
                ->padString('_')
                ->padLength('4')
                ->generate()
        );

        // $this->assertEquals("21011000000", $documentNumberer->generate());
    }

    /** @test */
    public function it_can_separate_by_team_id()
    {
        $testDate = Carbon::create(2021, 1, 1);
        Carbon::setTestNow($testDate);

        $documentNumber = new DocumentNumberer();
        $this->assertEquals("2101000001", $documentNumber->teamId(1)->generate());

        $documentNumber = new DocumentNumberer();
        $this->assertEquals("2101000001", $documentNumber->teamId("2")->generate());
    }
}
