<?php

namespace Modules\allegro\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;

class AllegroController extends FrameworkBundleAdminController
{
    private $token = '';
    /**
    * TIP: You can create test api here:  https://apps.developer.allegro.pl.allegrosandbox.pl/new
    */
    private $clientId = "client_id_from_api";
    private $clientSecret = "client_secret_from_api";

    public function __construct()
    {
        $this->renderToken();
    }

    public function indexAction(Request $request)
    {
        // GET my offer by phrase 'candle'
        // $myoffer = $this->getMyOffer('candle');

        return $this->render('@Modules/allegro/src/Resources/views/index.html.twig', [
            'title'         => 'Allegro module - get cateogiries',
            'categories'    => $this->getCategories()
        ]);
    }

    public function getMyOffer($phrase) {

        $getCategoriesUrl   = "https://api.allegro.pl.allegrosandbox.pl/offers/listing";
        $query              = ['phrase' => $phrase];
        $getChildrenUrl     = $getCategoriesUrl . '?' . http_build_query($query);

        $ch = curl_init($getChildrenUrl);

        /**
         * Specify request content
         */
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 'POST raw request content');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                     "Authorization: Bearer $this->token",
                     "Accept: application/vnd.allegro.public.v1+json",
                     'Content-Type: application/vnd.allegro.public.v1+json',
        ]);

        $mainCategoriesResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($mainCategoriesResult === false || $resultCode !== 200) {
            exit ("Something went wrong");
        }

        $categoriesList = json_decode($mainCategoriesResult);

        return $categoriesList;

    }
    public function getCategories(){
        $getCategoriesUrl = "https://api.allegro.pl.allegrosandbox.pl/sale/categories";

        $ch = curl_init($getCategoriesUrl);

        /**
         * Specify request content
         */
        // Example POST
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 'POST raw request content');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                     "Authorization: Bearer $this->token",
                     "Accept: application/vnd.allegro.public.v1+json"
        ]);

        $mainCategoriesResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($mainCategoriesResult === false || $resultCode !== 200) {
            exit ("Something went wrong");
        }

        $categoriesList = json_decode($mainCategoriesResult);

        return $categoriesList;
    }

    public function renderToken(){
        $authUrl = "https://allegro.pl.allegrosandbox.pl/auth/oauth/token?grant_type=client_credentials";
        // From account api
        $ch = curl_init($authUrl);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERNAME, $this->clientId);
        curl_setopt($ch, CURLOPT_PASSWORD, $this->clientSecret);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $tokenResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($tokenResult === false || $resultCode !== 200) {
            exit ("Something went wrong");
        }
        $tokenObject = json_decode($tokenResult);
        $this->token = $tokenObject->access_token;
        // return "access_token = ".$tokenObject->access_token;;
    }
}
