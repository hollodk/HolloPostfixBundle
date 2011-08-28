<?php

namespace ITG\PostfixBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $transport = $em->getRepository('ITGPostfixBundle:Transport')->findAll();

    return $this->render('ITGPostfixBundle:Default:index.html.twig', array(
      'transports' => $transport
    ));
  }

  public function newAction()
  {
    $transport = new \ITG\PostfixBundle\Entity\Transport;
    $transport->setTransport('smtp:');

    $form = $this->createForm(new \ITG\PostfixBundle\Form\Transport, $transport);

    if ($this->getRequest()->getMethod() == 'POST') {
      $form->bindRequest($this->getRequest());

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($transport);
        $em->flush();

        $this->get('session')->setFlash('notice', 'Transport added');
        return $this->redirect($this->generateUrl('homepage'));
      }
    }

    return $this->render('ITGPostfixBundle:Default:new.html.twig', array(
      'form' => $form->createView()
    ));
  }

  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $transport = $em->find('ITGPostfixBundle:Transport', $id);

    $form = $this->createForm(new \ITG\PostfixBundle\Form\Transport, $transport);

    if ($this->getRequest()->getMethod() == 'POST') {
      $form->bindRequest($this->getRequest());

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($transport);
        $em->flush();

        $this->get('session')->setFlash('notice', 'Transport updated');
        return $this->redirect($this->generateUrl('homepage'));
      }
    }

    return $this->render('ITGPostfixBundle:Default:update.html.twig', array(
      'form' => $form->createView(),
      'transport' => $transport
    ));
  }

  public function deleteAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $transport = $em->find('ITGPostfixBundle:Transport', $id);

    $em->remove($transport);
    $em->flush();

    $this->get('session')->setFlash('notice','Transport has been removed');
    return $this->redirect($this->generateUrl('homepage'));
  }
}
