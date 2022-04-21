<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmployeesRequest;
use Log;
use App\Contracts\LemburRepositoryInterface;
use App\Models\Settings;
use App\Models\References;
use App\Models\Employees;
use App\Models\Overtimes;

class LemburController extends Controller
{
    private $lemburRepository;
    private $paginationLimit = 50;
    private $paginationOffset = 0;

    public function __construct(
        LemburRepositoryInterface $lemburRepository

    ) {
        $this->lemburRepository = $lemburRepository;
    }
    /**
     * @OA\Post(
     *      path="/api/v1/post-employees",
     *      operationId="post-employees",
     *      tags={"Employees"},
     *      summary="Post Employees",
     *      description="Post Employees",
     *      @OA\Parameter(
     *          name="name",
     *          required=true,
     *          in="query"
     *      ),
     *    @OA\Parameter(
     *          name="status_id",
     *          required=true,
     *          in="query"
     *      ),
     *    @OA\Parameter(
     *          name="salary",
     *          required=true,
     *          in="query"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful stored",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function postEmployees(Request $request){
        return $this->lemburRepository->create($request);
    }
    /**
     * @OA\Get(
     *      path="/api/v1/employees",
     *      operationId="getEmployees",
     *      tags={"Employees"},
     *      summary="Get Employees information",
     *      description="Returns Employees data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="/App/Http/Resources/EmployeesResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function getEmployees(Request $request){
        return $this->lemburRepository->getEmployeesPaginated($request, $limit = 10, $offset = 0);
    }
    public function postEmployeesas(CreateEmployeesRequest $request){
        return $this->lemburRepository->createRequest($request);
    }
      /**
     * @OA\Post(
     *      path="/api/v1/post-overtimes",
     *      operationId="post-overtimes",
     *      tags={"postOvertimes"},
     *      summary="Post Overtimes",
     *      description="Post Overtimes",
     *      @OA\Parameter(
     *          name="employee_id",
     *          required=true,
     *          in="query"
     *      ),
     *    @OA\Parameter(
     *          name="date",
     *          required=true,
     *          in="query"
     *      ),
     *    @OA\Parameter(
     *          name="time_started",
     *          required=true,
     *          in="query"
     *      ),
     *    @OA\Parameter(
     *          name="time_ended",
     *          required=true,
     *          in="query"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful stored",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function postOvertimes(Request $request){
        return $this->lemburRepository->createOvertimes($request);
    }
}

