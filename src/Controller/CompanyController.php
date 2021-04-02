<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */

class CompanyController extends AbstractController
{
    /**
     * @Route("/create", name="company_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $company = new Company();
        $company->setOwner($this->getUser());
        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('job_offer_index');
        }

        return $this->render('company/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
