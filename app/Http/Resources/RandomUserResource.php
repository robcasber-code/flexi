<?php

namespace App\Http\Resources;

class RandomUserResource
{
    public static function transform(array $user): array
    {
        return [
            'username'   => $user['login']['username'],
            'first_name' => $user['name']['first'],
            'last_name'  => $user['name']['last'],
            'email'      => $user['email'],
            'password'   => md5($user['login']['password']),
            'gender'     => $user['gender'],
            'country'    => $user['location']['country'],
            'city'       => $user['location']['city'],
            'phone'      => $user['phone'],
        ];
    }
}
