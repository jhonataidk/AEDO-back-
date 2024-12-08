<?php

namespace App\Interfaces;

interface OrgaoServiceInterface
{
    public function getAllOrgaos();
    public function getOrgaoById($id);
    public function createOrgao(array $data);
    public function updateOrgao(array $data, $id);
    public function deleteOrgao($id);
}
