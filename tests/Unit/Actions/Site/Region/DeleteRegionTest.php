<?php

namespace Tests\Unit\Actions\Site\Region;

use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteRegionTest extends TestCase
{
    public function testShouldDeleteRegion()
    {
        $mockRegion = $this->partialMock(Region::class, function (MockInterface $mock) {
            $mock->shouldReceive('delete')->once()->andReturn(true);
        });

        $deleteRegionResult = DeleteRegion::run($mockRegion);

        $this->assertEquals($deleteRegionResult, true);
    }
}
