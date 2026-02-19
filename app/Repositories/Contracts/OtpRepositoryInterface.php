<?php
namespace App\Repositories\Contracts;

interface OtpRepositoryInterface extends BaseRepositoryInterface
{
    public  function validate(string $identifier, string $token): bool;
}
