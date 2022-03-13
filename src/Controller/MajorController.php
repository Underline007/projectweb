<?php

namespace App\Controller;

use App\Entity\Major;
use App\Form\MajorType;
use App\Entity\Studentmanager;
use Doctrine\ORM\Query\Expr\Math;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/major')]
class MajorController extends AbstractController
{
    #[Route('', name: 'major_index')]
    public function ViewAllMajor() {
        //b1: lấy dữ liệu từ db
        //SQL: SELECT * FROM book
        $major = $this->getDoctrine()->getRepository(Major::class)->findAll();
        //b2: render ra view gửi kèm dữ liệu ở trên
        return $this->render("major/index.html.twig",
            [
                'majors' => $major
            ]);

    }

    #[Route('/detail/{id}', name: 'major_detail')]
    public function ViewMajorById ($id) {
        //b1: lấy dữ liệu từ db
        //SQL: SELECT * FROM book WHERE id = '$id'
        $major = $this->getDoctrine()->getRepository(Major::class)->find($id);
        if ($major == null) {
            $this->addFlash("Error","Major not found !");
            //redirect về trang book index
            return $this->redirectToRoute('major_index');
        }
        //b2: render ra view gửi kèm dữ liệu ở trên
        return $this->render("major/detail.html.twig",
        [
            'major' => $major
        ]);
    }

    #[Route('/delete/{id}', name: 'major_delete')]
    public function DeleteMajor ($id) {
        //b1: lấy dữ liệu từ db
        //SQL: SELECT * FROM book WHERE id = '$id'
        $major = $this->getDoctrine()->getRepository(Major::class)->find($id);
        if ($major == null) {
            $this->addFlash("Error","Major not found !");
        } else {
            //gọi đến entity manager để xóa object
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($major);
            $manager->flush();
            //gửi message từ controller đến view sau khi xóa thành công
            $this->addFlash("Success","Delete Major succeed !");
        }
        //redirect về trang book index
        return $this->redirectToRoute('major_index');
    }

    #[Route('/add ', name: 'major_add')]
    public function addMajor (Request $request) {
        $major = new Major;
        $form = $this->createForm(MajorType::class,$major);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($major);
            $manager->flush();
            return $this->redirectToRoute('major_index');
        }
        return $this->renderForm('major/add.html.twig',
        [
            'majorForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'major_edit')]
    public function editMajor (Request $request, $id) {
        $major = $this->getDoctrine()->getRepository(Major::class)->find($id);
        $form = $this->createForm( MajorType::class,$major);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($major);
            $manager->flush();
            return $this->redirectToRoute('major_index');
        }
        return $this->renderForm('major/edit.html.twig',
        [
            'majorForm' => $form
        ]);
    }
}