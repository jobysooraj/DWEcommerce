<?php

namespace App\Repositories;

use App\Models\Cart;

interface CartRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getCartItemsForUser($userId);
    public function getCartItemsCountForUser($userId);

}
