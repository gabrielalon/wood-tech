<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Unit\ReadModel\Model;

use Components\Accounts\ReadModel\Model\AdminsPaginated;
use Illuminate\Support\Arr;
use Tests\Components\Accounts\Utils\Assemblers\AdminAssembler;
use Tests\UnitTestCase;

final class AdminsPaginatedTest extends UnitTestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $model = new AdminsPaginated(
            [$admin = AdminAssembler::new()->assemble()],
            $total = 1,
            $perPage = 5,
            $currentPage = 1,
            $options = [],
        );

        self::assertEquals($admin, Arr::first($model->admins));
        self::assertEquals($total, $model->total);
        self::assertEquals($perPage, $model->perPage);
        self::assertEquals($currentPage, $model->currentPage);
        self::assertEquals($options, $model->options);
    }
}
