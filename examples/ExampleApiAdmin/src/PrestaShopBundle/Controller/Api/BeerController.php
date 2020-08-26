<?php

namespace PrestaShopBundle\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BeerController extends ApiController {
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $result = array(
            'data' => array(
                array(
                    'id' => 1,
                    'name' => 'Heineken',
                    'description' => 'Not taste'
                ),
                array(
                    'id' => 2,
                    'name' => 'Kormoran',
                    'description' => 'Better tast',
                ),
                array(
                    'id' => 2,
                    'name' => 'Zywiec',
                    'description' => 'Its good too',
                ),
            )
        );

        return $this->jsonResponse($result, $request);
    }
}
