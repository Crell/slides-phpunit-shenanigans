<?php

namespace Crell\Shenanigans\Integration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use PHPUnit\Framework\Attributes\Before;

trait UseDoctrine
{
    private Connection $conn;

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
        //$this->conn->executeQuery('CREATE TABLE users ...');
    }

}
