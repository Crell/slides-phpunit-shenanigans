<?php

namespace Crell\Shenanigans\Integration;

use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;

trait TransactionIsolation
{
    use UseDoctrine;

    #[Before]
    public function startTransaction(): void
    {
        $this->conn->beginTransaction();
    }

    #[After]
    public function endTransaction(): void
    {
        $this->conn->rollBack();
    }
}
