<?php

namespace Tests\Unit\Actions\Site\Municity;

use App\Actions\Site\Municity\DeleteMunicity;
use App\Models\Site\Municity;
use Mockery;
use PHPUnit\Framework\TestCase;

class DeleteMunicityTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testShouldDeleteMunicity(): void
    {
        $mockMunicity = Mockery::mock(Municity::class)->makePartial();
        $mockMunicity->shouldReceive('delete')->once()->andReturn(true);

        $deleteMunicityResult = DeleteMunicity::run($mockMunicity);

        $this->assertEquals($deleteMunicityResult, true);
    }
}
