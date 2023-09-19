<?php
namespace App\Repositories;

interface EmailsRepository extends BaseRepository
{
    public function getEmails();
    public function updateData($id, $data);
}
