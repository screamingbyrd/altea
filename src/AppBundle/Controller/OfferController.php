<?php
/**
 * Created by PhpStorm.
 * User: Altea IT
 * Date: 29/10/2018
 * Time: 09:50
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

class OfferController extends Controller
{

    public function searchPageAction(Request $request){
        $type = $request->get('type');
        $city = $request->get('city');
        $from = $request->get('from');
        $to = $request->get('to');
        $rent = $request->get('rent');
        $rent = isset($rent)?1:0;
        $sell = $request->get('sell');
        $sell = isset($sell)?1:0;
        $new = $request->get('new');
        $new = isset($new)?1:0;
        $currentPage = $request->get('row');
        $currentPage = isset($currentPage)?$currentPage:1;
        $numberOfItem =  $request->get('number');
        $numberOfItem = isset($numberOfItem)?$numberOfItem:50;

        $offerRepository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Offer')
        ;
        $offers = $offerRepository->findAll();

        $typeArray = $cityArray = array();

        foreach ($offers as $offer){
            $typeArray[$offer->getType()][] = 1;
            $cityArray[$offer->getCity()][] = 1;
        }
        $typeArray = array_keys($typeArray);
        $cityArray = array_keys($cityArray);

        $searchArray = array();

        if(isset($type) and $type != ''){
            $searchArray['type'] = $type;
        }
        if(isset($city) and $city != ''){
            $searchArray['city'] = $city;
        }

        if($sell or $rent or $new){
            $transactionArray = array();
            if($sell){
                $transactionArray[] = 'sell';
            }
            if($rent){
                $transactionArray[] = 'rent';
            }
            if($new){
                $transactionArray[] = 'new';
            }

            $searchArray['transaction'] = $transactionArray;
        }

        if(isset($from) and $from != ''){
            $searchArray['from'] = $from;
        }

        if(isset($to) and $to != ''){
            $searchArray['to'] = $to;
        }

        $finalData = $offerRepository->searchOffer($searchArray);

        $locationArray =array();

        $countResult = count($finalData);


        $finalArray = array_slice($finalData, ($currentPage - 1 ) * $numberOfItem, $numberOfItem);

        foreach ($finalArray as $offer){
            $address = $offer->getLocation();
            if($address != ''){
                $marker = $this->get('app.find_latlong')->geocode($address);
                $marker[] = $this->get('translator')->trans($offer->getType());
                $marker[] = ' url ';
                $marker[] = 'image';
                $marker[] = '0123';
                $locationArray[$offer->getId()] = $marker;
            }
        }

        $totalPage = ceil ($countResult / $numberOfItem);

        return $this->render('AppBundle::searchPage.html.twig',
            array(
                'data' => $finalArray,
                'page' => $currentPage,
                'total' => $totalPage,
                'numberOfItem' =>($numberOfItem > $countResult? $countResult:$numberOfItem),
                'countResult' => $countResult,
                'location' => $locationArray,
                'cities' => $cityArray,
                'types' => $typeArray,
                'givenCity' => $city,
                'givenType' => $type,
                'rent' => $rent,
                'sell' => $sell,
                'new' => $new,
                'from' => $from,
                'to' => $to,
            )
        );
    }

    public function showAction(Request $request){
        $id = $request->get('id');

        $offerRepository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Offer')
        ;
        $offer = $offerRepository->findOneBy(array('id' => $id));

        $session = $request->getSession();
        if(!isset($offer)){
            $translated = $this->get('translator')->trans('redirect.candidate');
            $session->getFlashBag()->add('danger', $translated);
            return $this->redirectToRoute('altea_home');
        }

        $location = $this->get('app.find_latlong')->geocode($offer->getLocation());

        return $this->render('AppBundle::showRoom.html.twig',
            array(
                'offer' => $offer,
                'location' => $location
            )
        );
    }

}