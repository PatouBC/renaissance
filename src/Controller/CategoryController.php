<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Image;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", host="renaissance-terrehappy.fr")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="category_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('image')->get('file')->getData();
            if($file){
                $image = new Image();
                $fileName=$this->generateUniqueFileName().'.'.$file->guessExtension();

                try{
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName
                    );
                }catch(FileException $e){

                }
                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImgPath($this->getParameter('image_path').'/'.$fileName);
                $entityManager->persist($image);
                $category->setImage($image);
            }else{
                $category->setImage(null);
            }
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @Route("/{id}", name="category_show", methods={"GET"})
     */
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $image = $category->getImage();
            $file = $form->get('image')->get('file')->getData();

            if($file)
            {

                $fileName=$this->generateUniqueFileName().'.'.$file->guessExtension();

                try{
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName
                    );
                }catch(FileException $e){

                }
                $this->removeFile($image->getPath());

                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImgPath($this->getParameter('image_path').'/'.$fileName);
                $entityManager->persist($image);
                $category->setImage($image);
            }
            if(empty($image->getId())&& !$file)
            {
                $category->setImage(null);
            }
            $entityManager->flush();

            return $this->redirectToRoute('category_index', [
                'id' => $category->getId(),
            ]);
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $image = $category->getImage();
            if($image){
                $this->removeFile($image->getPath());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_index');
    }
    /**
     * @Route("/{id}", name="category_image_delete", methods={"POST"})
     */
    public function deleteImg(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $image = $category->getImage();
            $this->removeFile($image->getPath());
            $category->setImage(null);
            $entityManager->remove($image);
            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->redirectToRoute('category_edit', array('id'=>$category->getId()));
    }
    private function removeFile($path)
    {
        if(file_exists($path))
        {
            unlink($path);
        }
    }
}
