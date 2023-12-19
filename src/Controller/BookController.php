<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Form\SearchType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    #[Route('/book', name: 'app_book')]
    public function getBook(Request $req, BookRepository $rep): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($req);
        $nbBooks = $rep->getNbBooks();

        if ($form->isSubmitted()) {

            return $this->renderForm('book/listBookDB.html.twig', [
                "form" => $form,
                "books" => $rep->searchBookByRef($book->getTitle()),
                "nb" => $nbBooks
            ]);
        
        }
    
        return $this->renderForm('book/listBookDB.html.twig', [
            "form" => $form,
            "books" => $rep->getBooks(),
            "nb" => $nbBooks
        ]);
    }
    #[Route('/showBookByAuthor', name: 'app_bookByAuth')]
    public function showBookByAuthor(BookRepository $rep): Response
    {

        $list = $rep->showBooksByAuthor();

        return $this->render('book/listBookDB.html.twig', [
            "books" => $list,
        ]);
    }


    #[Route('/delete/{id}', name: 'book_deleteDB')]
    public function deleteBook($id, BookRepository $repo, ManagerRegistry $manager): Response
    {

        $em = $manager->getManager();

        $book = $repo->find($id);

        if ($book != null) {

            $em->remove($book);
            $em->flush();
        }

        return $this->redirectToRoute('app_book');
    }

    #[Route('/addBook', name: 'book_addDB')]
    public function addBook(Request $req, ManagerRegistry $manager): Response
    {

        $em = $manager->getManager();
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {

            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('app_book');
        }

        return $this->renderForm('book/FormBook.html.twig', [
            "form" => $form,
        ]);
    }
    #[Route('/updateBook/{id}', name: 'book_updateBook')]
    public function updateBook($id, Request $req, BookRepository $rep, ManagerRegistry $manager): Response
    {

        $em = $manager->getManager();
        $book = $rep->find($id);
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {

            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('app_book');
        }

        return $this->renderForm('book/FormBook.html.twig', [
            "form" => $form,
        ]);
    }

    // #[Route('/searchBookByRef', name: 'app_bookByRef')]
    // public function searchBookByRef(Request $req, BookRepository $rep): Response
    // {
    //     $book = new Book();
    //     $form = $this->createForm(SearchType::class, $book);
    //     $form->handleRequest($req);

    //     if ($form->isSubmitted()) {

    //         // $book = $req->get('ref');
    //         // dd($book);
    //         $list = $rep->searchBookByRef($book->getTitle());
    //         return $this->render('book/listBookDB.html.twig', [
    //             "form" => $form->createView(),
    //             "books" => $list,
    //         ]);
    //     }

    //     return $this->renderForm('book/listBookDB.html.twig', [
    //         "form" => $form,
    //         "books" => $rep->findAll(),
    //     ]);
    // }
}
