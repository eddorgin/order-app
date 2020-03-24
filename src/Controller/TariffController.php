<?php


namespace App\Controller;


use App\Domain\Tariff\TariffService;
use DomainException;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Swagger\Annotations as SWG;

/**
 * Class TariffController
 * @package App\Controller
 */
class TariffController
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var TariffService
     */
    private $tariffService;

    /**
     * TariffController constructor.
     * @param TariffService $tariffService
     */
    public function __construct(TariffService $tariffService)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
        $this->tariffService = $tariffService;
    }

    /**
     * @return JsonResponse
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает доступные тарифы"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Произошла ошибка"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Не найдены тарифы"
     * )
     *
     * @SWG\Tag(name="tariffs")
     */
    public function getAllTariffs()
    {
        try
        {
            $tariffs = $this->tariffService->getAllTariffs();
            $response = new JsonResponse('Не найдены тарифы', Response::HTTP_NOT_FOUND);

            if ($tariffs)
            {
                $response = new JsonResponse($tariffs, Response::HTTP_OK);
            }

            return $response;
        }
        catch (DomainException $exception)
        {
            return new JsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch (Exception $exception)
        {
            return new JsonResponse('Внутренняя ошибка', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     * @SWG\Response(
     *     response=200,
     *     description="Returns success message"
     * )
     * @SWG\Response(
     *     response=500,
     *     description="Returns error"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not found entity"
     * )
     *
     * @SWG\Tag(name="tariffs")
     */
    public function getTariffById($id)
    {
        try
        {
            $tariffId = $id;
            $tariff = $this->tariffService->getTariffById($tariffId);

            if ($tariff)
            {
                $jsonData = $this->serializer->serialize($tariff, 'json');
                return new JsonResponse($jsonData, Response::HTTP_OK);
            }

            return new JsonResponse("Тариф с id {$tariffId} не найден", Response::HTTP_NOT_FOUND);
        }
        catch (DomainException $exception)
        {
            return new JsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch (Exception $exception)
        {
            return new JsonResponse('Внутренняя ошибка', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}