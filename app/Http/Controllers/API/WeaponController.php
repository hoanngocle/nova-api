<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Http\Requests\User\CreateWeaponRequest;
use App\Http\Requests\User\UpdateWeaponRequest;
use App\Services\WeaponService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class WeaponController extends Controller
{
    /**
     * @var WeaponService
     */
    protected WeaponService $weaponService;

    /**
     * @param WeaponService $weaponService
     */
    public function __construct(WeaponService $weaponService)
    {
        $this->weaponService = $weaponService;
    }

    /**
     * Get list of weapon
     *
     * @param CommonListRequest $request
     * @return JsonResponse
     */
    public function index(CommonListRequest $request): JsonResponse
    {
        $result = $this->weaponService->getList($request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Get detail of weapon
     *
     * @param $id
     * @return JsonResponse
     */
    public function detail($id): JsonResponse
    {
        $result = $this->weaponService->getWeapon($id);

        return response()->json($result, $result['code']);
    }

    /**
     * Create new weapon
     *
     * @param CreateWeaponRequest $request
     * @return JsonResponse
     */
    public function store(CreateWeaponRequest $request): JsonResponse
    {
        $result = $this->weaponService->create($request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Update a weapon
     *
     * @param $id
     * @param UpdateWeaponRequest $request
     * @return JsonResponse
     */
    public function update($id, UpdateWeaponRequest $request): JsonResponse
    {
        $result = $this->weaponService->update($id, $request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Delete a weapon
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $result = $this->weaponService->delete($id);

        return response()->json($result, $result['code']);
    }


    public function sendMail()
    {
        $to_name = "Hoan Ngoc Le";
        $to_email = "hoanngocle.93@gmail.com";
        $data = array("name"=> "Ogbonna Vitalis(sender_name)", "body" => "A test mail");
        Mail::send("emails.mail", $data, function($message) use ($to_name, $to_email) {
            $message->from(env('MAIL_FROM_ADDRESS'), 'Love')
                ->to($to_email, $to_name)
                ->subject("Laravel Test Mail");
        });
    }
}
