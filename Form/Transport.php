<?php

namespace Hollo\PostfixBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Transport extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('domain');
    $builder->add('transport');
  }

  public function getDefaultOptions(array $options)
  {
    return array(
      'data_class' => 'Hollo\PostfixBundle\Entity\Transport'
    );
  }

  public function getName()
  {
    return 'transport';
  }
}

