<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;

class EntityController extends Controller
{
    /**
     * @Route("/addProduct", name="addProduct")
     */
    public function addProduct()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setTitle("Macbook");
        $product->setPrice(1000);
        $product->setActive(true);

        $category = new Category();
        $category->setTitle("Laptop");
        $category->addProduct($product);

        $entityManager->persist($category);
        $entityManager->flush();

        return new Response('Saved new product '.$product->getTitle());
    }

    /**
     * @Route("/removeProduct/{id}", name="removeProduct")
     */
    public function removeProduct(Product $product)
    {
        $entityManager = $this->getDoctrine()->getManager();        

        $entityManager->remove($product);
        $entityManager->flush();

        return new Response('Deleted product '.$product->getTitle());
    }


}
