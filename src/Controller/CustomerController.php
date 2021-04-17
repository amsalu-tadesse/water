<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/customer")
 */
class CustomerController extends AbstractController
{
    // /**
    //  * @Route("/", name="customer_index", methods={"GET"})
    //  */
    // public function index(CustomerRepository $customerRepository): Response
    // {
    //     return $this->render('customer/index.html.twig', [
    //         'customers' => $customerRepository->findAll(),
    //     ]);
    // }

    // /**
    //  * @Route("/new", name="customer_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request): Response
    // {
    //     $customer = new Customer();
    //     $form = $this->createForm(CustomerType::class, $customer);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($customer);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('customer_index');
    //     }

    //     return $this->render('customer/new.html.twig', [
    //         'customer' => $customer,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="customer_show", methods={"GET"})
    //  */
    // public function show(Customer $customer): Response
    // {
    //     return $this->render('customer/show.html.twig', [
    //         'customer' => $customer,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="customer_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, Customer $customer): Response
    // {
    //     $form = $this->createForm(CustomerType::class, $customer);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('customer_index');
    //     }

    //     return $this->render('customer/edit.html.twig', [
    //         'customer' => $customer,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="customer_delete", methods={"POST"})
    //  */
    // public function delete(Request $request, Customer $customer): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($customer);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('customer_index');
    // }
        /**
     * @Route("/", name="customer_index", methods={"GET","POST"}) 
     */
    public function index(CustomerRepository $customerRepository,Request $request, PaginatorInterface $paginator): Response
    {

        if($request->request->get('edit')){
            $id=$request->request->get('edit');
            $customer=$customerRepository->findOneBy(['id'=>$id]);
            $form = $this->createForm(CustomerType::class, $customer);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('customer_index');
            }

            $queryBuilder=$customerRepository->findCustomer($request->query->get('search'));
            $data=$paginator->paginate(
                $queryBuilder,
                $request->query->getInt('page',1),
                18
            );
            return $this->render('customer/index.html.twig', [
                'customers' => $data,
                'form' => $form->createView(),
                'edit'=>$id
            ]);

        }
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('customer_index');
        }

        $search = $request->query->get('search');
        
        $queryBuilder=$customerRepository->findCustomer($search);
        $data=$paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page',1),
            18
        );
        return $this->render('customer/index.html.twig', [
            'customers' => $data,
            'form' => $form->createView(),
            'edit'=>false
        ]);
    }  
 
    /**
     * @Route("/{id}", name="customer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Customer $customer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('customer_index');
    }
}