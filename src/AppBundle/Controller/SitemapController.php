<?php
/**
 * Created by PhpStorm.
 * User: Altea IT
 * Date: 04/07/2018
 * Time: 08:32
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SitemapController extends Controller
{

    public function sitemapAction(Request $request)
    {
        $locale = $request->get('_locale');

        // We define an array of urls
        $urls = [];
        // We store the hostname of our website
        $hostname = $request->getHost();

        //AppBundle routing

        $urls[] = ['loc' =>
            'https://altea.lu' . $this->get('router')->generate('altea_home',array('_locale' => $locale)), 'changefreq' => 'daily', 'priority' => '1.0'
        ];

        $urls[] = ['loc' =>
            'https://altea.lu' . $this->get('router')->generate('contact_us',array('locale' => $locale, '_locale' => $locale)), 'changefreq' => 'weekly', 'priority' => '1.0'
        ];

        $urls[] = ['loc' =>
            'https://altea.lu' . $this->get('router')->generate('search_page',array('locale' => $locale, '_locale' => $locale)), 'changefreq' => 'weekly', 'priority' => '1.0'
        ];

        // Then, we will find all our articles stored in the database
        $offerRepository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Offer');
        $offers = $offerRepository->findAll();

        $generateUrlService = $this->get('app.offer_generate_url');

        // We loop on them
        foreach ($offers as $offer) {
            $urls[] = ['loc' =>
                'https://altea.lu' . $this->get('router')->generate('show_offer',array('locale' => $locale, '_locale' => $locale, 'id' => $offer->getId(), 'url' => $generateUrlService->generateOfferUrl($offer))), 'changefreq' => 'daily', 'priority' => '1.0'
            ];
        }


        // Once our array is filled, we define the controller response
        $response = new Response($this->renderView('AppBundle:Default:sitemap.xml.twig', [
            'urls' => $urls,
            'hostname' => $hostname
        ]));
        $response->headers->set('Content-Type', 'xml; charset=utf-8');

        return $response;
    }


}