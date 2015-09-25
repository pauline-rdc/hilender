<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pret;
use AppBundle\Form\Type\PretType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class PretController extends Controller
{

    /**
     * @Route("/pret", name="pret_list")
     * @Template("AppBundle:Pret:list.html.twig")
     */
    public function listAction()
    {
        //  if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
        // return array('');
        //  }
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('AppBundle:Pret');
        $prets = $repos->findAll();

        return array('prets' => $prets);
    }

    /**
     * @Route("/pret/add", name="pret_add")
     * @Template("AppBundle:Pret:form.html.twig")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(new PretType(), new Pret());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('pret_list'));
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/pret/{id}", name="pret_view")
     * @Template("AppBundle:Pret:index.html.twig")
     */
    public function viewAction()
    {
        return array();
    }

    /**
     * @Route("/pret/update/{id}", name="pret_delete")
     * @Template("AppBundle:Pret:form.html.twig")
     */
    public function updateAction(Pret $pret)
    {
        return array( 'pret' => $pret);
    }


    /**
     * @Route("/pret/delete/{id}", name="pret_delete")
     * @Template()
     */
    public function deleteAction(Pret $pret)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pret);
        $em->flush();

        return $this->redirect($this->generateUrl("pret_list"));
    }
}
