<?php
/**
 * Created by PhpStorm.
 * User: Altea IT
 * Date: 30/05/2018
 * Time: 16:21
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Trt\SwiftCssInlinerBundle\Plugin\CssInlinerPlugin;

class AppController extends Controller
{


    public function indexAction(Request $request)
    {

        $offerRepository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Offer')
        ;

        $offers = $offerRepository->findAll();

        $typeArray = $cityArray = $sousTypeArray = array();


        $generateUrlService = $this->get('app.offer_generate_url');

        foreach ($offers as $offer){
            $typeArray[$offer->getType()][] = 1;
            $sousTypeArray[$offer->getSousType()][] = 1;
            $cityArray[$offer->getCity()][] = 1;
            $offer->setOfferUrl($generateUrlService->generateOfferUrl($offer));
        }
        $typeArray = array_keys($typeArray);
        $cityArray = array_keys($cityArray);
        $sousTypeArray = array_keys($sousTypeArray);

        if(!empty(array_intersect (['GARAGE', 'EMPLACEMENT DE PARKING', 'PARKING'], $sousTypeArray))){
            $typeArray[] = 'Garage';
        }

        shuffle($offers);

        $offerArray = array();

        for($i = 0; $i <= 3; $i++){
            if(isset($offers[$i])){
                $offerArray[] = $offers[$i];
            }

        }

        $seoPage = $this->container->get('sonata.seo.page');

        $seoPage
            ->addMeta('property', 'og:title', 'Votre agence immobilière à Luxembourg')
            ->addMeta('property', 'og:type', 'website')
            ->addMeta('property', 'og:image', 'https://altea.lu/images/7_web.jpg')
            ->addMeta('property', 'og:description', 'Votre agence immobilière au Luxembourg')
            ->addMeta('property', 'og:url', $request->getUri())
            ->addMeta('property', 'og:site_name', 'Altea');

        return $this->render('AppBundle:Default:index.html.twig', array(
            'cities' => $cityArray,
            'types' => $typeArray,
            'offerArray' => $offerArray
        ));

    }

    public function AboutPageAction(Request $request)
    {

        return $this->render('AppBundle:Footer:about.html.twig');

    }

    public function faqPageAction(Request $request)
    {

        return $this->render('AppBundle:Footer:faq.html.twig');

    }

    public function privacyPageAction(Request $request)
    {

        return $this->render('AppBundle:Footer:privacy.html.twig');

    }

    public function legalPageAction(Request $request)
    {

        return $this->render('AppBundle:Footer:legal.html.twig');

    }

    public function mediaPageAction(Request $request)
    {

        return $this->render('AppBundle:Footer:media.html.twig');

    }


}