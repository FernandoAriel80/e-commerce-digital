<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct() {}

    public function getAll($limit)
    {
        return User::where('is_active', true)
            ->select('first_name', 'last_name', 'email', 'created_at')
            ->orderByDesc('created_at')
            ->paginate($limit);
    }
    public function allSearch($search, $limit)
    {
        $query = User::where('is_active', true)
            ->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });

        return $query->paginate($limit)->appends(['search' => $search]);
    }

    public function getById(string $id)
    {
        return User::find($id);
    }
    public function getByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function create(array $array)
    {
        return User::create($array);
    }

    public function update(string $id, array $data)
    {
        //return User::where('id', $id)->update($data);
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function delete(string $id)
    {
        return User::where('id', $id)->delete();
    }

    public function createOrUpdate(array $data)
    {
        return User::updateOrCreate($data);
    }
}
