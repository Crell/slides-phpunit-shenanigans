<?php

namespace Crell\Shenanigans\Integration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    private Connection $conn;

    public function setUp(): void
    {
        // Set up a fake Doctrine instance.
        $dsnParser = new DsnParser();
        $connectionParams = $dsnParser
            ->parse('pdo-sqlite:///:memory:');
        $this->conn = DriverManager::getConnection($connectionParams);

        $this->conn->executeQuery('CREATE TABLE users ...');
    }

    #[Before(20)]
    public function setupDoctrine(): void
    {
        // Set up a fake Doctrine instance.
        $dsnParser = new DsnParser();
        $connectionParams = $dsnParser
            ->parse('pdo-sqlite:///:memory:');
        $this->conn = DriverManager::getConnection($connectionParams);
    }

    #[Before(10)]
    public function setupTables(): void
    {
        $this->conn->executeQuery('CREATE TABLE users ...');
    }

    #[Test]
    public function stuff(): void
    {
        $this->conn->insert('users', ['id' => 1, 'name' => 'Larry']);

        // Do stuff ...

        $result = $this->conn->executeQuery('SELECT ...')->fetchOne();
        self::assertSame('Larry', $result);
    }
}
