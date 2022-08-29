<?php

namespace Tests\Unit\Actions\Site\Province;

use App\Actions\Site\Province\DeleteProvince;
use App\Models\Site\Province;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteProvinceTest extends TestCase
{
    public function testShouldDeleteProvince()
    {
        $mockProvince = $this->partialMock(Province::class, function (MockInterface $mock) {
            $mock->shouldReceive('delete')->once()->andReturn(true);
        });

        $deleteProvinceResult = DeleteProvince::run($mockProvince);

        $this->assertEquals($deleteProvinceResult, true);
    }
}
