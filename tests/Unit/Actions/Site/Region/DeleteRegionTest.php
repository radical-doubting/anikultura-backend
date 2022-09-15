<?php

namespace Tests\Unit\Actions\Site\Region;

use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;
use Mockery;
use PHPUnit\Framework\TestCase;

class DeleteRegionTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testShouldDeleteRegion(): void
    {
        $mockRegion = Mockery::mock(Region::class)->makePartial();
        $mockRegion->shouldReceive('delete')->once()->andReturn(true);

        $deleteRegionResult = DeleteRegion::run($mockRegion);

        $this->assertEquals($deleteRegionResult, true);
    }
}
