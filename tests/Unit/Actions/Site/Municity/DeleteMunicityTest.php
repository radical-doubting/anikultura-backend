<?php

namespace Tests\Unit\Actions\Site\Municity;

use App\Actions\Site\Municity\DeleteMunicity;
use App\Models\Site\Municity;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteMunicityTest extends TestCase
{
    public function testShouldDeleteMunicity()
    {
        $mockMunicity = $this->partialMock(Municity::class, function (MockInterface $mock) {
            $mock->shouldReceive('delete')->once()->andReturn(true);
        });

        $deleteMunicityResult = DeleteMunicity::run($mockMunicity);

        $this->assertEquals($deleteMunicityResult, true);
    }
}
