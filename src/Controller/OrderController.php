<?php


namespace App\Controller;


use App\Domain\Order\OrderService;
use DomainException;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;

/**
 * Class OrderController
 * @package App\Controller
 */
class OrderController
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(
        OrderService $orderService
    )
    {
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @SWG\Response(
     *     response=200,
     *     description="Returns success message"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Returns error"
     * )
     *
     * @SWG\Parameter(
     *     name="phone",
     *     in="formData",
     *     type="string",
     *     required=true,
     *     description="Your phone"
     * )
     * @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     type="string",
     *     required=true,
     *     description="Your name"
     * )
     * @SWG\Parameter(
     *     name="tariff_id",
     *     in="formData",
     *     type="string",
     *     required=true,
     *     description="Choosen tariff"
     * )
     * @SWG\Parameter(
     *     name="delivery_day",
     *     in="formData",
     *     type="string",
     *     required=true,
     *     description="Choosen delivery day"
     * )
     * @SWG\Parameter(
     *     name="address",
     *     in="formData",
     *     type="string",
     *     required=true,
     *     description="Choosen delivery address"
     * )
     * @SWG\Tag(name="order")
     */
    public function makeOrder(Request $request)
    {
        try
        {
            $data = $request->request->all();

            if ($this->orderService->save($data))
            {
                return new JsonResponse('Order added succesful', Response::HTTP_OK);
            }
        }
        catch (DomainException $exception)
        {
            return new JsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch (Exception $exception)
        {
            return new JsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        };
    }
}