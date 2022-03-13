<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/subject")]
class SubjectController extends AbstractController
{
    #[Route('', name: 'subject_index')]
    public function viewAllSubject()
    {   
        $subject = $this->getDoctrine()->getRepository(Subject::class)->findAll();
        return $this->render('subject/index.html.twig',
            [
            'subjects' => $subject
            ]);
    }

    #[Route('/detail/{id}', name: 'subject_detail')]
    public function viewSubjectById($id)
    {   
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        if($subject ==null){
            $this->addFlash("Error","Subject not found");
            return $this->redirectToRoute('subject_index');
        }
        return $this->render('subject/detail.html.twig',
            [
            'subject' => $subject
            ]);
    }

    #[Route('/delete/{id}', name: 'subject_delete')]
    public function deleteSubjectById($id)
    {   
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        if($subject ==null){
            $this->addFlash("Error","Subject nor found");
        }else{
            //goi den  entity manager de xoa boject
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($subject);
        $manager->flush();
        //gui message tu controller den view sau khi xoa thanh cong
        $this->addFlash("Success","Delete subject succeed");
        }
        //redirect ve trang subject index
        return $this->redirectToRoute('subject_index');

    }
    #[Route('/add', name:'subject_add')]
    public function addBook(Request $request){
        $subject = new Subject;
        $form = $this->createForm(SubjectType::class,$subject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute('subject_index');
        }
        return $this->renderForm('subject/add.html.twig',
        [
            'sf'=>$form
        ]);
    }


    #[Route('/edit/{id}', name:'subject_edit')]
    public function editBook(Request $request, $id){
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        $form = $this->createForm(SubjectType::class,$subject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute('subject_index');
        }
        return $this->renderForm('subject/edit.html.twig',
        [
            'sf'=>$form
        ]);
        
    }

    #[Route('/asc',name:'sort_id_asc')]
    public function sortAsc (SubjectRepository $repository) {
        $subjects = $repository->sortSubjectAsc();
        return $this->render("subject/index.html.twig",
        [
            'subjects' => $subjects
        ]);
    }

    #[Route('/desc',name:'sort_id_desc')]
    public function sortDesc (SubjectRepository $repository) {
        $subjects = $repository->sortSubjectDesc();
        return $this->render("subject/index.html.twig",
        [
            'subjects' => $subjects
        ]);
    }
}
