<?php

namespace App\Controller;

use App\Entity\Measurement;
use App\Form\MeasurementType;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class MeasurementController extends AbstractController
{
    public function index(MeasurementRepository $measurementRepository): Response
    {
        return $this->render('measurement/index.html.twig', [
            'measurements' => $measurementRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDIT")
     */
    public function new(Request $request): Response
    {
        $measurement = new Measurement();
        $form = $this->createForm(MeasurementType::class, $measurement, [
            'validation_groups' => 'new_measurement'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($measurement);
            $entityManager->flush();

            return $this->redirectToRoute('measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('measurement/new.html.twig', [
            'measurement' => $measurement,
            'form' => $form->createView(),
        ]);
    }

    public function show(Measurement $measurement): Response
    {
        return $this->render('measurement/show.html.twig', [
            'measurement' => $measurement,
        ]);
    }

    /**
     * @IsGranted("ROLE_EDIT")
     */
    public function edit(Request $request, Measurement $measurement): Response
    {
        $form = $this->createForm(MeasurementType::class, $measurement, [
            'validation_groups' => 'edit_measurement'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('measurement/edit.html.twig', [
            'measurement' => $measurement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDIT")
     */
    public function delete(Request $request, Measurement $measurement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$measurement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($measurement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('measurement_index', [], Response::HTTP_SEE_OTHER);
    }
}
