<?php

namespace Hollo\PostfixBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StatController extends Controller
{
  public function indexAction()
  {
    // read any ini file and insert into table view
    $file = '/home/itg/data.txt';

    if (!is_readable($file)) {
      $this->get('session')->setFlash('error','Something is wrong with the stat file.');
      return $this->redirect($this->generateUrl('homepage'));
    }

    $data = parse_ini_file($file);

    $res = array();
    foreach ($data as $key=>$value) {
      $res[ucfirst(preg_replace("/_/", " ", $key))] = $value;
    }

    return $this->render('HolloPostfixBundle:Stat:index.html.twig', array(
      'data' => $res
    ));
  }
}
