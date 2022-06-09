<?php

namespace System\Eloquent;

use Illuminate\Support\Facades\DB;

final class Connection
{
    public function beginTransaction(): void
    {
        DB::connection('mysql')->beginTransaction();
    }

    public function commit(): void
    {
        DB::connection('mysql')->commit();
    }

    public function rollBack(): void
    {
        DB::connection('mysql')->rollBack();
    }
}
