<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AuthorController extends AbstractController
{
    #[Route('/api/authors', name: 'app_author',methods:['GET'])]
    public function getAllAuthor(AuthorRepository $authorRepository,SerializerInterface $serializer): JsonResponse
    {
        $allAuthors = $authorRepository->findAll();
        $allAuthorsJson = $serializer->serialize($allAuthors,'json',['groups' => 'getBooks']);
        return new JsonResponse($allAuthorsJson,Response::HTTP_OK,[],true);
    }
    #[Route('/api/authors/{id}',name:'detailAuthor',methods:['GET'])]
    public function getDetailAuthor(SerializerInterface $serializer,Author $author)
    {
        $oneAuthor = $serializer->serialize($author,'json',['groups' => 'getBooks']);
        return new JsonResponse($oneAuthor,Response::HTTP_OK,[],true);
    }
    #[Route('/api/authors/{id}',name:'deleteAuthor',methods:['DELETE'])]
    public function DeleteAuthors(EntityManagerInterface $em,Author $author)
    {    
        $em->remove($author);
        $em->flush();
        return new JsonResponse(null,Response::HTTP_NO_CONTENT);
    }
       
}
