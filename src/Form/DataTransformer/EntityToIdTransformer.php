<?php

// src/Form/DataTransformer/IssueToNumberTransformer.php
namespace App\Form\DataTransformer;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EntityToIdTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (customer) to a string (number).
     *
     * @param  Customer|null $customer
     * @return string
     */
    public function transform($customer)
    {
        if (null === $customer || "" === $customer) {
            return '';
        }

        dump($customer);

        return $customer->getId();
    }

    /**
     * Transforms a string (number) to an object (customer).
     *
     * @param  string $issueNumber
     * @return Customer|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($customerNumber)
    {
        // no issue number? It's optional, so that's ok
        if (!$customerNumber) {
            return;
        }

        $customer = $this->entityManager
            ->getRepository(Customer::class)
            // query for the issue with this id
            ->find($customerNumber)
        ;

        if (null === $customer) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An customer with number "%s" does not exist!',
                $customerNumber
            ));
        }

        return $customer;
    }
}