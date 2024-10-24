<?php

namespace App\Repositories;

interface PermissionRepositoryInterface
{
    public function create(array $data);
    public function findByName(string $name);
    public function listAll();    
    public function delete($id); // Add delete method
    public function update($id, array $data); // Add method for updating


}
