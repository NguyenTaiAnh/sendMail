<?php
namespace App\Repositories;

interface UsersRepository extends BaseRepository
{
    public function getUsers();
    public function updateData($id, $data);
}
