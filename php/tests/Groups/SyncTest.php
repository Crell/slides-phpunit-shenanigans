<?php

namespace Crell\Shenanigans\Groups;

use Crell\Shenanigans\Integration\UseDoctrine;
use Crell\Shenanigans\Sync\Sync;
use http\Client;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('Sync')]
class SyncTest extends TestCase {
    use UseDoctrine;

    private Sync $sync;

    #[Before]
    public function makeSubject(): void {
        $this->sync = new Sync(new Client(), $this->conn);
    }

    #[Test, Group('database')]
    public function writeToDb(): void {
        $this->sync->saveData('...');
        self::assertEquals('...', $this->conn->executeQuery("...")->fetchOne());
    }

    #[Test]
    public function cleaning(): void {
        self::assertSame('blah', $this->sync->cleanData('Blah'));
    }

    #[Test, Group('connected')]
    public function getData(): void {
        $data = $this->sync->getData();
        // ...
    }
}
