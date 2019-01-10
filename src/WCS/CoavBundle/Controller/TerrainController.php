<?php

namespace WCS\CoavBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use WCS\CoavBundle\Entity\Airport;
use WCS\CoavBundle\Entity\Search;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use WCS\CoavBundle\Repository\TerrainRepository;

/**
 * Airport controller.
 *
 * @Route("terrain")
 */
class TerrainController extends Controller
{
    /**
     * Lists all terrain entities.
     *
     * @Route("/", name="terrain_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $terrains = $em->getRepository('Airport.php')->findAll();

        return $this->render('terrain/index.html.twig', array(
            'terrains' => $terrains,
        ));
    }

    /**
     * Finds and displays a terrain entity.
     *
     * @Route("/{id}", name="terrain_show")
     * @Method("GET")
     */
    public function showAction(Airport $terrain)
    {

        return $this->render('terrain/show.html.twig', array(
            'terrain' => $terrain,
        ));
    }

    /**
     * Creates a new terrain entity.
     *
     * @Route("/new", name="terrain_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_PILOT')")
     */
    public function newAction(Request $request)
    {
        $terrain = new Airport();
        $form = $this->createForm('WCS\CoavBundle\Form\TerrainType', $terrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($terrain);
            $em->flush();

            return $this->redirectToRoute('terrain_show', array(
                'id' => $terrain->getId()));
        }

        return $this->render('terrain/new.html.twig', array(
            'terrain' => $terrain,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing terrain entity.
     *
     * @Route("/{id}/edit", name="terrain_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_PILOT')")
     */
    public function editAction(Request $request, Airport $terrain)
    {
        $deleteForm = $this->createDeleteForm($terrain);
        $editForm = $this->createForm('WCS\CoavBundle\Form\TerrainType', $terrain);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('terrain_edit', array(
                'id' => $terrain->getId()));
        }

        return $this->render('terrain/edit.html.twig', array(
            'terrain' => $terrain,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a terrain entity.
     *
     * @Route("/{id}", name="terrain_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Airport $terrain)
    {
        $form = $this->createDeleteForm($terrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($terrain);
            $em->flush();
        }

        return $this->redirectToRoute('terrain_index');
    }

    /**
     * Creates a form to delete a terrain entity.
     *
     * @param Airport $terrain The terrain entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Airport $terrain)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('terrain_delete', array('id' => $terrain->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function searchAction(Request $request, TerrainRepository $terrainRepository)
    {
        $search = new Search;
        $form = $this->createForm('WCS\CoavBundle\Form\SearchType', $search);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $results = $terrainRepository->findByPertinence($search, TerrainRepository::FIELDS);
        }

        return $this->render('@WCSCoav/partials/search.html.twig', [
            'form' => $form->createView(),
            'result' => $results,
        ]);
    }
}
