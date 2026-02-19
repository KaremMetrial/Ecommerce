<?php
namespace App\Repositories;

use Ichtrojan\Otp\Otp;
use Ichtrojan\Otp\Models\Otp as OtpModel;
use App\Repositories\Contracts\OtpRepositoryInterface;
class OtpRepository extends BaseRepository implements OtpRepositoryInterface
{
    public function __construct(OtpModel $model)
    {
        parent::__construct($model);
    }
    public function create(array $data)
    {
        return (new Otp)->generate($data['identifier'], 'numeric', 4, $data['validity'] = 10);
    }
    public function validate(string $identifier, string $token): bool
    {
        $validation = (new Otp)->validate($identifier, $token);
        return $validation->status == true;
    }
}
