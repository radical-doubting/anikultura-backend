<?php

namespace Tests\Unit\Actions\Site\Province;

use App\Actions\Site\Province\CreateProvince;
use App\Models\Site\Province;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProvinceTest extends TestCase
{
    public function testShouldCreateProvince()
    {
        $mockProvince = $this->partialMock(Province::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->once()->andReturn(true);
        });

        $createdProvince = CreateProvince::run($mockProvince, [
            'name' => 'Laguna',
            'region_id' => 1,
        ]);

        $this->assertEquals($createdProvince->name, 'Laguna');
        $this->assertEquals($createdProvince->region_id, 1);
    }
}
