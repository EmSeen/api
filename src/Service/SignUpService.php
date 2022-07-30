<?php


namespace App\Service;


use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Model\SingUpRequest;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpService
{
    public function __construct(private UserPasswordHasherInterface $hasher,
                                private UserRepository $userRepository,
                                private EntityManagerInterface $em,
                                private AuthenticationSuccessHandler $successHandler)
    {
    }

    public function singUp(SingUpRequest $singUpRequest): Response
    {
        if ($this->userRepository->existByEmail($singUpRequest->getEmail())) {
            throw new UserAlreadyExistsException();
        }

        $user = (new User())
            ->setRoles(['ROLE_USER'])
            ->setFirstName($singUpRequest->getFirstName())
            ->setLastName($singUpRequest->getLastName())
            ->setEmail($singUpRequest->getEmail());

        $user->setPassword($this->hasher->hashPassword($user, $singUpRequest->getPassword()));

        $this->em->persist($user);
        $this->em->flush();

        return $this->successHandler->handleAuthenticationSuccess($user);
    }
}
