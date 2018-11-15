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

        $API_URL = "https://www.easy-serveur14.com/altea4488/easy2pilot/soft/api/v2/getAnnonces";
        $headers = [
            'token: 3e73d2ef7312614d6d0216cba72b81a2',
        ];
        try {
            $ch = curl_init($API_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, true );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            $info = curl_getinfo($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $result = json_decode($result, true);
            var_dump($result['data'][0]);exit;
            If ( $httpcode !== 200 )
                echo ( 'Error with httpcode ' .$httpcode );
            if ( $result['status'] != 200 )
                echo ('Error with message ' .$result['error'] );

        } catch(\Exception $e) {}

        $em = $this->getDoctrine()->getManager();

        foreach ($result['data'] as $data){
            $offer = new Offer();

            $offer->setType($data['info']['nature']);
            $offer->setDescription($data['description']['description_fr']);
            $offer->setDescriptionEn($data['description']['description_en']);
            $offer->setCity($data['localisation']['ville']);
            $offer->setPrice($data['prix']['budget']);
            $offer->setTransaction($data['info']['vente_location']=='location'?'rent':'sell');
            $offer->setLocation($data['localisation']['adresse']);
            $offer->setReference($data['info']['reference']);
            $offer->setEntryDate(new \datetime($data['info']['date_entree']));
            $offer->setOld($data['info']['achat_type']=='ancien'?true:false);
            $offer->setZipcode($data['localisation']['code_postal']);
            $offer->setCountry($data['localisation']['pays']);
            $offer->setCharge($data['prix']['charges_mensuelles']);
            $offer->setShowPrice($data['prix']['cacher_prix']);
            $offer->setHall($data['pieces']['hall']);
            $offer->setKitchen($data['pieces']['cuisine']);
            $offer->setEquiped($data['pieces']['cuisine_equipee']);
            $offer->setOpen($data['pieces']['cuisine_independante']);
            $offer->setLiving($data['pieces']['sejour']);
            $offer->setDoubleLiving($data['pieces']['sejour_double']);
            $offer->setOffice($data['pieces']['bureau']);
            $offer->setNbrShower($data['pieces']['salle_de_douche']);
            $offer->setNbrBathroom($data['pieces']['salles_de_bain']);
            $offer->setSeparatedBathroom($data['pieces']['wc_separe']);
            $offer->setCupboard($data['pieces']['placard']);
            $offer->setBasement($data['pieces']['cave']);
            $offer->setNbrBedroom($data['info']['nombre_chambres']);
            $offer->setSurface($data['info']['surface']);
            $offer->setTerrase($data['exterieur']['surface_terrasse']);
            $offer->setBalcon($data['exterieur']['surface_balcon']);
            $offer->setGarden($data['exterieur']['surface_jardin']);
            $offer->setVeranda($data['exterieur']['surface_veranda']);
            $offer->setLoggia(200);
            $offer->setSwimmingPool($data['exterieur']['piscine']);
            $offer->setAttic($data['interieur']['surface_grenier']);
            $offer->setBuanderie($data['interieur']['buanderie']);
            $offer->setRenovated($data['interieur']['renove']);
            $offer->setMeuble($data['interieur']['meuble']);
            $offer->setPet($data['interieur']['animaux_acceptes']);
            $offer->setCaveVin($data['interieur']['cave_a_vin']);
            $offer->setNbrFloor($data['localisation']['nombre_etage']);
            $offer->setFloor($data['localisation']['numero_etage']);
//            $offer->setLastFloor(false);
            $offer->setExternalParking($data['parking']['parking_ouvert']);
            $offer->setInternalParking($data['parking']['parking_souterrain']);
            $offer->setGarage($data['parking']['garages']);
            $offer->setLift($data['confort']['ascenseur']);
            $offer->setAntenna($data['confort']['antenne_satellite']);
            $offer->setVoletsRoul($data['confort']['volets_roulants']);
            $offer->setVoletsElec($data['confort']['volets_electriques']);
            $offer->setHandicape($data['confort']['installation_handicapes']);
            $offer->setPorteBlindee($data['securite']['porte_blindee']);
            $offer->setParlophone($data['securite']['parlophone']);
            $offer->setVideophone($data['securite']['videophone']);
            $offer->setDigicode($data['securite']['digicode']);
            $offer->setAlarme($data['securite']['alarme']);
            $offer->setEnergy($data['energie']['indice_energetique']);
            $offer->setEnergyValue($data['energie']['valeur_indice_energetique']);
            $offer->setGes($data['energie']['indice_isolation']);
            $offer->setGesValue($data['energie']['valeur_indice_isolation']);
            $offer->setDpeInProgress($data['energie']['dpe_en_cours']);
//            $offer->setDpeNotApplicable(true);
//            $offer->setDpeVirgin(true);
            $offer->setGaz($data['chauffage']['chauffage_gaz']);
            $offer->setElec($data['chauffage']['chauffage_elect']);
            $offer->setFuel($data['chauffage']['chauffage_mazout']);
            $offer->setCollectif($data['chauffage']['chauffage_col']);
            $offer->setCharbon($data['chauffage']['charbon']);
            $offer->setGranules($data['chauffage']['granules']);
            $offer->setClim($data['chauffage']['climatisation']);
            $offer->setCheminee($data['chauffage']['cheminee']);
            $offer->setInsertHeat($data['chauffage']['insert_cheminee']);
//            $offer->setCentral(false);
            $offer->setRadiateur($data['chauffage']['radiateurs']);
//            $offer->setCollectiveWater(true);
//            $offer->setGazWater(true);
//            $offer->setElecWater(true);

            foreach ($data['photos'] as $photo){
                $image = new Image();

                $img = '/uploads/images/offer/'.$photo['name'];
                file_put_contents($img, file_get_contents('https://www.easy-serveur14.com/altea4488/easy2pilot/soft/api/v2'.$photo['hash']));

                $image->setImageName($photo['name']);
                $image->setOffer($offer);
                $image->setUpdatedAt(new \datetime());

                $offer->addImage($image);
            }



            $em->persist($offer);
            $em->flush();
            exit;
        }

        $em->flush();

        return new Response();
    }

}