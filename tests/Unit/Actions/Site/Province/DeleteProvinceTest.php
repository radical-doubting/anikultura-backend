<?php

namespace Tests\Unit\Actions\Site\Province;

use App\Actions\Site\Province\DeleteProvince;
use App\Models\Site\Province;
use Mockery;
use Tests\TestCase;

class DeleteProvinceTest extends TestCase
{
    public function testShouldDeleteProvince()
    {
        $mockProvince = Mockery::mock(Province::class)->makePartial();
        $mockProvince->shouldReceive('delete')->once()->andReturn(true);

        $deleteProvinceResult = DeleteProvince::run($mockProvince);

        $this->assertEquals($deleteProvinceResult, true);
    }
}
