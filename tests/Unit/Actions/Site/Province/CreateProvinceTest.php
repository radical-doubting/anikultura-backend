<?php

namespace Tests\Unit\Actions\Site\Province;

use App\Actions\Site\Province\CreateProvince;
use App\Models\Site\Province;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateProvinceTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testShouldCreateProvince(): void
    {
        $mockProvince = Mockery::mock(Province::class)->makePartial();
        $mockProvince->shouldReceive('save')->once()->andReturn(true);

        $createdProvince = CreateProvince::run($mockProvince, [
            'name' => 'Laguna',
            'region_id' => 1,
        ]);

        $this->assertEquals($createdProvince->name, 'Laguna');
        $this->assertEquals($createdProvince->region_id, 1);
    }
}
