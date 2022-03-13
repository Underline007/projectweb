<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\TeacherRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/teacher")]
class TeacherController extends AbstractController
{
    #[Route('', name: 'teacher_index')]
    public function viewAllTeacher()
    {   
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->findAll();
        return $this->render('teacher/index.html.twig',
            [
            'teachers' => $teacher
            ]);
    }

    #[Route('/detail/{id}', name: 'teacher_detail')]
    public function viewTeacherById($id)
    {   
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        if($teacher ==null){
            $this->addFlash("Error","teacher not found");
            return $this->redirectToRoute('teacher_index');
        }
        return $this->render('teacher/detail.html.twig',
            [
            'teacher' => $teacher
            ]);
    }

    #[Route('/delete/{id}', name: 'teacher_delete')]
    public function deleteTeacherById($id)
    {   
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        if($teacher ==null){
            $this->addFlash("Error","teacher not found");
        }else{
            //goi den  entity manager de xoa boject
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($teacher);
        $manager->flush();
        //gui message tu controller den view sau khi xoa thanh cong
        $this->addFlash("Success","Delete teacher succeed");
        }
        //redirect ve trang teacher index
        return $this->redirectToRoute('teacher_index');

    }

    #[Route('/asc',name:'sort_title_asc')]
    public function sortAsc (TeacherRepository $repository) {
        $teachers = $repository->sortTeacherAsc();
        return $this->render("teacher/index.html.twig",
        [
            'teachers' => $teachers
        ]);
    }

    #[Route('/desc',name:'sort_title_desc')]
    public function sortDesc (TeacherRepository $repository) {
        $teachers = $repository->sortTeacherDesc();
        return $this->render("teacher/index.html.twig",
        [
            'teachers' => $teachers
        ]);
    }
    #[Route('/add', name:'teacher_add')]
    public function addBook(Request $request){
        $teacher = new Teacher;
        $form = $this->createForm(TeacherType::class,$teacher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();
            return $this->redirectToRoute('teacher_index');
        }
        return $this->renderForm('teacher/add.html.twig',
        [
            'tf' => $form
        ]);
    }


    #[Route('/edit/{id}', name:'teacher_edit')]
    public function editBook(Request $request, $id){
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        $form = $this->createForm(TeacherType::class,$teacher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();
            return $this->redirectToRoute('teacher_index');
        }
        return $this->renderForm('teacher/edit.html.twig',
        [
            'tf'=>$form
        ]);
    }
}

