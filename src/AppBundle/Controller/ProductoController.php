<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Producto;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductoController extends Controller
{
    /**
     * @Route("/productos", name="productos")
     */
    public function productosAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('AppBundle:Producto')->findAll();
        return $this->render('producto/listar.html.twig', array(
          "productos"=> $productos
        ));
    }
    /**
     * @Route("/producto/insertar", name="insertar_producto")
     */
    public function insertarProductoAction(Request $request)
    {
        $producto = new Producto();
        $em = $this->getDoctrine()->getManager();
        $formulario = $this->createFormBuilder($producto)
          ->add('nombre', TextType::class)
          ->add('descripcion', TextareaType::class)
          ->add('precio', TextareaType::class)
          ->add('cantidad', TextareaType::class)
          ->add('categoria', EntityType::class, array(
            "class"=>"AppBundle:Categoria"
          ))
          ->add('Guardar', SubmitType::class)
          ->getForm();
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
          $em->persist($producto);
          $em->flush();
          return $this->redirectToRoute('productos');
        }

        return $this->render('producto/form.html.twig',array(
          "formulario"=> $formulario->createView()
        ));
    }
    /**
     * @Route("/producto/editar/{id}", name="editar_producto")
     */
    public function editarProductosAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('AppBundle:Producto')->find($id);
        $formulario = $this->createFormBuilder($producto)
          ->add('nombre', TextType::class)
          ->add('descripcion', TextareaType::class)
          ->add('precio', TextareaType::class)
          ->add('cantidad', TextareaType::class)
          ->add('categoria', EntityType::class, array(
            "class"=>"AppBundle:Categoria"
          ))
          ->add('Guardar', SubmitType::class)
          ->getForm();
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
          $em->persist($producto);
          $em->flush();
          return $this->redirectToRoute('productos');
        }

        return $this->render('producto/form.html.twig',array(
          "formulario"=> $formulario->createView()
        ));
    }
    /**
     * @Route("/producto/eliminar/{id}", name="eliminar_producto")
     */
    public function eliminarProductosAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('AppBundle:Producto')->find($id);
        $em->remove($producto);
        $em->flush();
        return $this->redirectToRoute('productos');

    }
}
