<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Categoria;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoriaController extends Controller
{
    /**
     * @Route("/categorias", name="categorias")
     */
    public function categoriasAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();
        return $this->render('categoria/listar.html.twig', array(
          "categorias"=> $categorias
        ));
    }
    /**
     * @Route("/categoria/insertar", name="insertar_categoria")
     */
    public function insertarCategoriasAction(Request $request)
    {
        $categoria = new Categoria();
        $em = $this->getDoctrine()->getManager();
        $formulario = $this->createFormBuilder($categoria)
          ->add('nombre', TextType::class)
          ->add('descripcion', TextareaType::class)
          ->add('Guardar', SubmitType::class)
          ->getForm();
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
          $em->persist($categoria);
          $em->flush();
          return $this->redirectToRoute('categorias');
        }

        return $this->render('categoria/form.html.twig',array(
          "formulario"=> $formulario->createView()
        ));
    }
    /**
     * @Route("/categoria/editar/{id}", name="editar_categoria")
     */
    public function editarCategoriasAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('AppBundle:Categoria')->find($id);
        $formulario = $this->createFormBuilder($categoria)
          ->add('nombre', TextType::class)
          ->add('descripcion', TextareaType::class)
          ->add('Guardar', SubmitType::class)
          ->getForm();
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
          $em->persist($categoria);
          $em->flush();
          return $this->redirectToRoute('categorias');
        }

        return $this->render('categoria/form.html.twig',array(
          "formulario"=> $formulario->createView()
        ));
    }
    /**
     * @Route("/categoria/eliminar/{id}", name="eliminar_categoria")
     */
    public function eliminarCategoriasAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('AppBundle:Categoria')->find($id);
        $em->remove($categoria);
        $em->flush();
        return $this->redirectToRoute('categorias');

    }
    /**
     * @Route("/categoria/listarproductos/{id}", name="listarproductos_categoria")
     */
    public function listarproductosCategoriasAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('AppBundle:Categoria')->find($id);
        $productos = $categoria->getProductos();
        return $this->render('producto/listar.html.twig', array(
          "productos"=> $productos
        ));

    }
}
