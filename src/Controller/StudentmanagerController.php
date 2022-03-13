<?php

namespace App\Controller;

use App\Entity\Studentmanager;
use App\Form\StudentmanagerType;
use App\Repository\StudentmanagerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/studentmanager')]
class StudentmanagerController extends AbstractController
{
    #[Route('', name: 'studentmanager_index')]
    public function ViewAllStudentmanager(StudentmanagerRepository $repository) {
        //b1: lấy dữ liệu từ db
        //SQL: SELECT * FROM book
        $studentmanager = $this->getDoctrine()->getRepository(Studentmanager::class)->findAll();
        $studentmanager = $repository->sortNameAscending();
        //b2: render ra view gửi kèm dữ liệu ở trên
        return $this->render("studentmanager/index.html.twig",
            [
                'studentmanagers' => $studentmanager
            ]);
        

    }

    #[Route('/detail/{id}', name: 'studentmanager_detail')]
    public function ViewStudentmanagerById ($id) {
        //b1: lấy dữ liệu từ db
        //SQL: SELECT * FROM book WHERE id = '$id'
        $studentmanager = $this->getDoctrine()->getRepository(Studentmanager::class)->find($id);
        if ($studentmanager == null) {
            $this->addFlash("Error","Studentmanager not found !");
            //redirect về trang book index
            return $this->redirectToRoute('studentmanager_index');
        }
        //b2: render ra view gửi kèm dữ liệu ở trên
        return $this->render("studentmanager/detail.html.twig",
        [
            'studentmanager' => $studentmanager
        ]);
    }

    #[Route('/delete/{id}', name: 'studentmanager_delete')]
    public function DeleteStudentmanager ($id) {
        //b1: lấy dữ liệu từ db
        //SQL: SELECT * FROM book WHERE id = '$id'
        $studentmanager = $this->getDoctrine()->getRepository(Studentmanager::class)->find($id);
        if ($studentmanager == null) {
            $this->addFlash("Error","Studentmanager not found !");
        } else {
            //gọi đến entity manager để xóa object
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($studentmanager);
            $manager->flush();
            //gửi message từ controller đến view sau khi xóa thành công
            $this->addFlash("Success","Delete Studentmanager succeed !");
        }
        //redirect về trang book index
        return $this->redirectToRoute('studentmanager_index'); 
    }
    #[Route('/asc', name: 'sort_name_asc')]
    public function sortAsc (StudentmanagerRepository $repository) {
        $studentmanagers = $repository->sortNameAscending();
        return $this->render("studentmanager/index.html.twig",
        [
            'studentmanagers' => $studentmanagers
        ]);
    }

    #[Route('/desc', name: 'sort_name_desc')]
    public function sortDesc (StudentmanagerRepository $repository) {
        $studentmanagers = $repository->sortNameDescending();
        return $this->render("studentmanager/index.html.twig",
        [
            'studentmanagers' => $studentmanagers
        ]);
    }

    #[Route('/add ', name: 'studentmanager_add')]
    public function addStudentmanager (Request $request) {
        $studentmanager = new Studentmanager;
        $form = $this->createForm(StudentmanagerType::class,$studentmanager);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($studentmanager);
            $manager->flush();
            return $this->redirectToRoute('studentmanager_index');
        }
        return $this->renderForm('studentmanager/add.html.twig',
        [
            'studentmanagerForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'studentmanager_edit')]
    public function editStudentmanager (Request $request, $id) {
        $studentmanager = $this->getDoctrine()->getRepository(Studentmanager::class)->find($id);
        $form = $this->createForm( StudentmanagerType::class,$studentmanager);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($studentmanager);
            $manager->flush();
            return $this->redirectToRoute('studentmanager_index');
        }
        return $this->renderForm('studentmanager/edit.html.twig',
        [
            'studentmanagerForm' => $form
        ]);
    }
}
