<?php
namespace App\Repositories;

use App\Models\Admin\Admin;
use App\Repositories\Contracts\AdminRepositoryInterface;
class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
    public function updateByEmail(string $email, array $data)
    {
        return $this->model->where('email', $email)->update($data);
    }
}
