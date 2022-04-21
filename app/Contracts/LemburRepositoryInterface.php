<?php

namespace App\Contracts;
use Illuminate\Http\Request;

interface LemburRepositoryInterface
{
    public function create(Request $request);
    public function createOvertimes(Request $request);
    public function getEmployeesPaginated($request, $limit = 10, $offset = 0);
    public function createRequest($request);
}