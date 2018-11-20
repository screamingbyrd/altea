<?php
/**
 * Created by PhpStorm.
 * User: Altea IT
 * Date: 03/07/2018
 * Time: 09:42
 */

namespace AppBundle\Service;

use Symfony\Component\Translation\TranslatorInterface;


class GenerateUrl
{

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator    = $translator;
    }

    /**
     * This method registers an user in the database manually.
     *
     * @return string
     **/
    public function generateOfferUrl($offer){
        $url = '';
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', '\'' => '','(' => '', ')' => '');

        $url.= $this->translator->trans($offer->getTransaction()) . '/';

        $url .= $this->translator->trans(in_array($offer->getSousType(), ['GARAGE', 'EMPLACEMENT DE PARKING', 'PARKING'])?$offer->getSousType():$offer->getType()) . '/';

        $location = $offer->getLocation();
        $location = strtr($location, $unwanted_array);
        $city = $offer->getCity();
        $city = strtr($city, $unwanted_array);
        $country = $offer->getCountry();
        $country = strtr($country, $unwanted_array);

        $address = '';
        if(isset($location) && $location !='' && strpos($location, '') == false){
            $address = $location . ', ';
        }
        if (isset($city) && $city != '' && strpos($city, '') == false){
            $address = $address . $city;

            if($city == 'Luxembourg' && $country == ''){
                $address.= ', Luxembourg';
            }
        }
        if (isset($country) && $country != '' && strpos($country, '') == false){
            $address = $address . ', ' .$country;
        }


        $url .=  str_replace([' ', '/', ','], '-', $address);
        return strtolower($url);
    }
}