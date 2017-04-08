<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Form\Type\DateTimePickerType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Content', ['class' => 'col-md-8'])
                ->add('title', TextType::class)
                ->add('slug', TextType::class)
                ->add('summary', TextType::class)
                ->add('content', TextareaType::class)
                ->add('publishedAt', DateTimePickerType::class)
            ->end()

            ->with('Meta data', ['class' => 'col-md-4'])
                ->add('author', EntityType::class, [
                    'class' => User::class,
                    'choice_label' => 'fullName',
                ])
                ->add('tags', EntityType::class, [
                    'class' => Tag::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => false,
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('title')
            ->add('tags', null, [], EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
            ])
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id')
            ->addIdentifier('title')
            ->add('slug')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Post
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }
}
