<?php

namespace Tests\Unit\Actions\Site\Region;

use App\Actions\Site\Region\CreateRegion;
use App\Models\Site\Region;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateRegionTest extends TestCase
{
    public function testShouldCreateRegion()
    {
        $mockRegion = $this->partialMock(Region::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->once()->andReturn(true);
        });

        $createdRegion = CreateRegion::run($mockRegion, [
            'name' => 'National Capital Region',
            'short_name' => 'NCR',
        ]);

        $this->assertEquals($createdRegion->name, 'National Capital Region');
        $this->assertEquals($createdRegion->short_name, 'NCR');
    }
}
