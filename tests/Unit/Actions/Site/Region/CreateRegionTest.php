<?php

namespace Tests\Unit\Actions\Site\Region;

use App\Actions\Site\Region\CreateRegion;
use App\Models\Site\Region;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateRegionTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testShouldCreateRegion(): void
    {
        $mockRegion = Mockery::mock(Region::class)->makePartial();
        $mockRegion->shouldReceive('save')->once()->andReturn(true);

        $createdRegion = CreateRegion::run($mockRegion, [
            'name' => 'National Capital Region',
            'short_name' => 'NCR',
        ]);

        $this->assertEquals($createdRegion->name, 'National Capital Region');
        $this->assertEquals($createdRegion->short_name, 'NCR');
    }
}
