<?php

namespace Crell\Shenanigans\Sync;

use Doctrine\DBAL\Connection;
use http\Client;

class Sync {
    public function __construct(
        private Client $client,
        private Connection $conn,
    ) {}

    public function getData(): string {
        $this->client->send();
        return $this->client->getResponse()->getBody()->toString();
    }

    public function saveData(string $data): void {
        $this->conn->insert('synced_data', ['data' => $data]);
    }

    public function cleanData(string $data): string {
        return strtolower($data);
    }
}
