<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private $encoder;
    private $serializer;

    public function __construct(SerializerInterface $serializer, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {
        $this->serialize = $serializer;
        $this->encoder = $encoder;
        $this->manager = $manager;
    } 
    /**
     * @Route(
     *     path="/api/users",
     *     methods={"POST"}
     *     )
     */
    public function addUsers(Request $request)
    {
        $userReq = json_decode($request->getContent(), true);
        $user = $this->serialize->denormalize($userReq, 'App\Entity\User');
        $user->setUsername($userReq["username"])
            ->setFirstname($userReq["firstname"])
            ->setLastName($userReq["lastname"])
            ->setProfile("client")
            ->setPassword($this->encoder->encodePassword($user, $userReq['pin']));

        $this->manager->persist($user);
        $this->manager->flush();

        return $this->json("Client unregister ave success");
        
    }
}
