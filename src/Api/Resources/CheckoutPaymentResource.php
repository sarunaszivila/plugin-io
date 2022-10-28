<?php //strict

namespace IO\Api\Resources;

use Plenty\Plugin\Http\Request;
use IO\Api\ApiResource;
use IO\Api\ApiResponse;
use IO\Api\ResponseCode;
use IO\Services\CheckoutService;
use Plenty\Plugin\Http\Response;

/**
 * Class CheckoutPaymentResource
 *
 * Resource class for the route `io/checkout/payment`.
 * @package IO\Api\Resources
 */
class CheckoutPaymentResource extends ApiResource
{
    /**
     * @var CheckoutService $checkoutService Instance of the CheckoutService.
     */
    private $checkoutService;

    /**
     * CheckoutPaymentResource constructor.
     * @param Request $request
     * @param ApiResponse $response
     * @param CheckoutService $checkoutService
     */
    public function __construct( Request $request, ApiResponse $response, CheckoutService $checkoutService )
    {
        parent::__construct( $request, $response );
        $this->checkoutService = $checkoutService;
    }

    /**
     * Prepare the payment before creating a new order.
     * @return Response
     */
    public function store():Response
    {
        $event = $this->checkoutService->preparePayment();
        return $this->response->create( $event, ResponseCode::OK );
    }
}
