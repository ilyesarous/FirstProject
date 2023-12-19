<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{

    public  $authors = array(
        array('id' => 1, 'picture' => '/images/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/images/william-shakespeare.jpg', 'username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/images/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
    );

    #[Route('/author/{name}', name: 'app_author')]
    public function index($name): Response
    {
        return $this->render('author/index.html.twig', [
            'name' => $name,
        ]);
    }
    #[Route('/show', name: 'app_author')]
    public function show(): Response
    {
        $tableSize = count($this->authors);
        // $nbBooks = 0;

        return $this->render('author/list.html.twig', [
            'authors' => $this->authors,
            'tableSize' => $tableSize,
            // 'nbBooks' => $nbBooks,

        ]);
    }

    #[Route('/show/details/{id}', name: "app_show")]
    public function getInfos($id): Response
    {
        return $this->render('author/detailsList.html.twig', [
            "id" => $id,
            "auth" => $this->authors,

        ]);
    }
    #[Route('/getAllAuthors', name: "app_listDB")]
    public function getAll(AuthorRepository $rep): Response
    {
        $list = $rep->findAll();
        return $this->render('author/listDB.html.twig', [
            "authors" => $list,

        ]);
    }
    #[Route('/getOne/{id}', name: "app_getOne")]
    public function getAuth(AuthorRepository $rep, $id): Response
    {

        $auth = $rep->find($id);
        return $this->render('author/detailDB.html.twig', [
            "author" => $auth,
        ]);
    }
    #[Route('/book/authors', name: 'app_bookAuth')]
    public function getAuthors(AuthorRepository $rep): Response
    {
        $list = $rep->getAuthors(0);
        return $this->render('author/listauthDB.html.twig', [
            "books" => $list,
        ]);
    }

    #[Route('/addAuthor', name: "app_addAuthor")]
    public function addAuthor(ManagerRegistry $manager): Response
    {

        $author = new Author();
        $author->setEmail("ilyes@gmail.com");
        $author->setUsername("ilyes");

        $em = $manager->getManager();
        $em->persist($author);
        $em->flush(); //execution de la fontion et applique les changement a la db
        return new Response("Author added");
    }

    #[Route('/addNewAuth', name: 'author_addDB')]
    public function addNewAuthor(Request $req, ManagerRegistry $manager): Response
    {

        $em = $manager->getManager();
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author); //bch thot les info mte3i ml formulaire lel $author
        $form->handleRequest($req); //bch te5ou request eli tbaathet mel form
        if ($form->isSubmitted()) {

            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('app_listDB');
        }

        return $this->renderForm('author/addNewAuthor.html.twig', [ //fi3ou4 render bch n9oul raw bch nraja3 formulaire
            "form" => $form,
        ]);
    }
    #[Route('/update/{id}', name: 'author_updateDB')]
    public function updateAuth(Request $req, $id, AuthorRepository $repo, ManagerRegistry $manager): Response
    {

        $em = $manager->getManager();
        // $author = new Author();
        $author = $repo->find($id);
        $form = $this->createForm(AuthorType::class, $author); //bch thot les info mte3i ml formulaire lel $author
        $form->handleRequest($req); //bch te5ou request eli tbaathet mel form
        if ($form->isSubmitted()) {

            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('app_listDB');
        }

        return $this->renderForm('author/addNewAuthor.html.twig', [ //fi3ou4 render bch n9oul raw bch nraja3 formulaire
            "form" => $form,
        ]);
    }
    #[Route('/delete/{id}', name: 'author_delete')]
    public function deleteAuth($id, AuthorRepository $repo, ManagerRegistry $manager): Response
    {

        $em = $manager->getManager();
        // $author = new Author();
        $author = $repo->find($id);

        $em->remove($author);
        $em->flush();


        return $this->redirectToRoute('app_listDB');
    }


    #[Route('/showAuthByEmail', name: 'app_bookAuth')]
    public function getAuthorsByEmail(AuthorRepository $rep): Response
    {
        $list = $rep->listAuthorByEmail();
        return $this->render('author/showAuth.html.twig', [
            "listAuth" => $list,
        ]);
    }
}
