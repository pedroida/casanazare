<?php

namespace Tests\Unit;

use App\Models\Stay;
use Tests\Cases\TestCaseUnit;

class StayTest extends TestCaseUnit
{
    /**
     * @return void
     */
    public function testShouldInsertStay()
    {
        $stay = factory(Stay::class)->create();

        $this->assertDatabaseHas('stays', [
            'id' => $stay->id,
            'type' => $stay->type,
            'client_id' => $stay->client_id,
            'source_id' => $stay->source_id,
            'responsible_id' => $stay->responsible_id,
            'entry_date' => $stay->entry_date,
            'departure_date' => $stay->departure_date,
        ]);
    }
}
