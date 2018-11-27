<?php
/**
 * Created by PhpStorm.
 * User: Altea IT
 * Date: 30/10/2018
 * Time: 11:24
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Trt\SwiftCssInlinerBundle\Plugin\CssInlinerPlugin;

class ContactController extends Controller
{

    public function contactAction(Request $request)
    {
        $session = $request->getSession();
        $name = $request->get('name');
        $emailSender = $request->get('email');
        $emailTo = $request->get('emailTo');
        $emailTo = isset($emailTo)?$emailTo:'contact@altea.lu';
        $message = $request->get('message');
        $type = $request->get('type');
        $type = isset($type)?$type:'contactUs';
        $problem = $request->get('problem');
        $problem = isset($problem)?$problem:0;
        $data = array('name' => $name, 'emailSender' => $emailSender, 'message' => $message);

        if ($request->isMethod('POST')) {
            // Send mail
            if($this->sendEmail($emailTo,$data, $type)){

                $translated = $this->get('translator')->trans('email.sent');
                $session->getFlashBag()->add('info', $translated);

                return $this->redirectToRoute('contact_us');
            }else{
                // An error ocurred, handle
                var_dump("Errooooor :(");
            }

        }

        return $this->render('AppBundle:Contact:contact.html.twig',array('type' => $type, 'emailTo' => $emailTo, 'problem' => $problem));
    }

    private function sendEmail($email, $data, $template){
        $mailer = $this->container->get('swiftmailer.mailer');

        $translated = $this->get('translator')->trans('email.contacted');
        $message = (new \Swift_Message($translated))
            ->setFrom('altea@noreply.lu')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'AppBundle:Emails:'.$template.'.html.twig',
                    array('data' => $data)
                ),
                'text/html'
            )
        ;

        $message->getHeaders()->addTextHeader(
            CssInlinerPlugin::CSS_HEADER_KEY_AUTODETECT
        );

//        if(isset($data['emailSender']) && $data['emailSender']){
//
//        }

        return $this->get('mailer')->send($message);
    }


    public function contactUsPageAction(Request $request)
    {

        $location = $this->get('app.find_latlong')->geocode("228 route d'esch, Luxembourg");
        return $this->render('AppBundle:Contact:contactUs.html.twig',
            array(
                'location' => $location
            ));

    }

    public function contactOfferAction(Request $request){
        $session = $request->getSession();
        $name = $request->get('name');
        $emailSender = $request->get('email');
        $message = $request->get('message');
        $offerId = $request->get('offerId');
        $type = $request->get('type');

        $mailer = $this->container->get('swiftmailer.mailer');

        $offerRepository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Offer')
        ;
        $offer = $offerRepository->findOneBy(array('id' => $offerId));

        $message = (new \Swift_Message('Sujet: '.$type. ' - '.$offerId .' '.$this->get('translator')->trans($offer->getType()).' '.$offer->getCity()))
            ->setFrom('altea@noreply.lu')
            ->setTo('contact@altea.lu')
            ->setBody(
                '<div>Nous avons été contacté</div><div>Sujet : '.$type.'</div><div>Offre : '. '<a href="https://alea.lu'.$this->generateUrl('show_offer', array('id' => $offerId, 'url' => '')) .'">offre</a></div><div>Email : '.$emailSender.'</div><div>Nom : '.$name.'</div><div>Message : '.$message.'</div>',
                'text/html'
            )
        ;

        $mailer->send($message);

        $translated = $this->get('translator')->trans('email.sent');
        $session->getFlashBag()->add('info', $translated);

        return $this->redirectToRoute('show_offer', array('id' => $offerId, 'url' => ''));
    }

}