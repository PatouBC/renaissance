<?php
namespace App\Form\DataTransformer;

use App\Entity\Category;
use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CategoryToNumberTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (category) to a string (number).
     *
     * @param CategoryToNumberTransformer|null $category
     * @return string
     */
    public function transform($category)
    {
        if (null === $category){
            return'';
        }
        return $category->getId();
    }

    /**
     * Transforms a string (number) to an object (category).
     *
     * @param string $categoryNumber
     * @return Category|null
     * @throws TransformationFailedException if object (category) is not found.
     */
    public function reverseTransform($categoryNumber)
    {
        // no issue number? It's optional, so that's ok
        if(!$categoryNumber){
            return;
        }

        $category = $this->entityManager
            ->getRepository( Category::class)
            ->find($categoryNumber)
        ;

        if (null === $category){
            throw new TransformationFailedException(sprintf(
                'A category with number "%s" does not exist!',
                $categoryNumber
            ));
        }
        return $category;
    }
}