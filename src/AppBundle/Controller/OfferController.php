<?php
/**
 * Created by PhpStorm.
 * User: Altea IT
 * Date: 29/10/2018
 * Time: 09:50
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Entity\Offer;
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
        $fromRoom = $request->get('fromRoom');
        $toRoom = $request->get('toRoom');
        $fromSurface = $request->get('fromSurface');
        $toSurface = $request->get('toSurface');
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

        if(isset($fromSurface) and $fromSurface != ''){
            $searchArray['fromSurface'] = $fromSurface;
        }

        if(isset($toSurface) and $toSurface != ''){
            $searchArray['toSurface'] = $toSurface;
        }

        if(isset($fromRoom) and $fromRoom != ''){
            $searchArray['fromRoom'] = $fromRoom;
        }

        if(isset($toRoom) and $toRoom != ''){
            $searchArray['toRoom'] = $toRoom;
        }

        $finalData = $offerRepository->searchOffer($searchArray);

        $locationArray =array();

        $countResult = count($finalData);


        $finalArray = array_slice($finalData, ($currentPage - 1 ) * $numberOfItem, $numberOfItem);

        foreach ($finalArray as $offer){
            $address = $offer->getLocation();
            if($address != ''){
                $marker = $this->get('app.find_latlong')->geocode($address);
                $marker[] = $this->get('translator')->trans($offer->getType()).' - '. $offer->getLocation();
                $marker[] = $this->generateUrl('show_offer', array('id' => $offer->getId()));
                $marker[] = 'image';
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
                'fromRoom' => $fromRoom,
                'toRoom' => $toRoom,
                'fromSurface' => $fromSurface,
                'toSurface' => $toSurface,
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

    public function processOffersAction(){

        $em = $this->getDoctrine()->getManager();

        $offer = new Offer();

        $offer->setType('type.house');
        $offer->setDescription('C\'est une description');
        $offer->setDescriptionEn('This is a description');
        $offer->setCity('Luxembourg');
        $offer->setPrice(40000);
        $offer->setTransaction('sell');
        $offer->setLocation('221 route d\'esch, Luxembourg');
        $offer->setReference('B.O.B.');
        $offer->setEntryDate(new \datetime());
        $offer->setOld(false);
        $offer->setZipcode('L-1547');
        $offer->setCountry('Luxembourg');
        $offer->setCharge(null);
        $offer->setShowPrice(true);
        $offer->setHall(true);
        $offer->setKitchen(true);
        $offer->setEquiped(true);
        $offer->setOpen(true);
        $offer->setLiving(true);
        $offer->setDoubleLiving(true);
        $offer->setOffice(true);
        $offer->setNbrShower(4);
        $offer->setNbrBathroom(2);
        $offer->setSeparatedBathroom(1);
        $offer->setCupboard(true);
        $offer->setBasement(true);
        $offer->setNbrBedroom(2);
        $offer->setSurface(200);
        $offer->setTerrase(200);
        $offer->setBalcon(200);
        $offer->setGarden(200);
        $offer->setVeranda(200);
        $offer->setLoggia(200);
        $offer->setSwimmingPool(true);
        $offer->setAttic(11);
        $offer->setBuanderie(true);
        $offer->setRenovated(true);
        $offer->setMeuble(true);
        $offer->setPet(true);
        $offer->setCaveVin(true);
        $offer->setNbrFloor(5);
        $offer->setFloor('4');
        $offer->setLastFloor(false);
        $offer->setExternalParking(1);
        $offer->setInternalParking(1);
        $offer->setGarage(1);
        $offer->setLift(true);
        $offer->setAntenna(true);
        $offer->setVoletsRoul(true);
        $offer->setVoletsElec(true);
        $offer->setHandicape(true);
        $offer->setPorteBlindee(true);
        $offer->setParlophone(true);
        $offer->setVideophone(true);
        $offer->setDigicode(true);
        $offer->setAlarme(true);
        $offer->setEnergy('A');
        $offer->setEnergyValue('4000');
        $offer->setGes('B');
        $offer->setGesValue('3000');
        $offer->setDpeInProgress(true);
        $offer->setDpeNotApplicable(true);
        $offer->setDpeVirgin(true);
        $offer->setGaz(true);
        $offer->setElec(true);
        $offer->setFuel(true);
        $offer->setCollectif(true);
        $offer->setCharbon(true);
        $offer->setGranules(true);
        $offer->setClim(true);
        $offer->setCheminee(true);
        $offer->setInsertHeat(true);
        $offer->setCentral(true);
        $offer->setRadiateur(true);
        $offer->setCollectiveWater(true);
        $offer->setGazWater(true);
        $offer->setElecWater(true);

        $image = new Image();

        $image->setImageName('download.jpg');
//        $image->setImageFile('uploads/images/offer/download.jpg');
        $image->setOffer($offer);
        $image->setUpdatedAt(new \datetime());

        $offer->addImage($image);

        $em->persist($offer);
        $em->flush();

        return new Response();
    }

}