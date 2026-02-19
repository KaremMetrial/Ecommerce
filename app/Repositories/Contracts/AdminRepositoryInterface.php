<?php
namespace App\Repositories\Contracts;

interface AdminRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email);
    public function updateByEmail(string $email, array $data);
}
