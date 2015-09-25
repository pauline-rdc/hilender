<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PretType extends  AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return  $builder
            ->add('name')
            ->add('description')
            ->add('type',null, array('required' => true))
            ->add('pictures', 'collection', array(
                'type' => new PictureType(),
                'allow_add' => true,
                'by_reference' => false,
            ))
            ->add('status', 'hidden', array('label' => 'Status : ', 'required' => false, 'data' => 1))
            ->add('btn', 'submit', array(
                'label' => 'Valider',
                'attr' => array('class' => 'btn btn-primary')))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pret',
        ));

        return $resolver;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'pret_type';
    }
}