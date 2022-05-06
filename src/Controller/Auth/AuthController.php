<?php

namespace App\Controller\Auth;

use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthController extends AbstractController
{
    private  $jwtManager;
    private  $tokenStorageInterface;

    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }
    #[Route('/index', name: 'app_auth')]
    public function index(Request $request): Response
    {

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTE3ODIyMzQsImV4cCI6MTY1MTc4NTgzNCwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiZGV2QnJhaW5zQGdtYWlsLmNvbSJ9.O90ww_3q_LgNM77d7CCQ1rvVVl-D8YxpWGFqIE1Z9zYG48OaVjwRnNUdNZgyEjbI9JJt-5h66J1DcfFu4xZXT-Xt41LKBTaeQYj7Sz8m1Ho-TYf5a3hXFJ_w8dXFnvrbl1kIZdoSnMp9mCW1IzPlrsxMpBvC9PUXg8hCb4apoqIj-sQMOlaWwUX6pNjs99NF896KIG2QsilI0fxVLKP_47iqqYi1WCIfJTWl1aeQRzMq6wrkUbF345Evpo72sK9z7l0wQxE5nC3gtOj18yTwVJLtlkgrKVOzn5Sy2eTdXGDR94EDLt1QBak1L6hRnC4SVdNtmCUX42sRJrDrVWLaVCqn3PDJU2zVrwBgYSZb1FGiQx2MaTo7nfFOMwkSG4JCVp_9dp8suUzO5sSEfrXXL0ZwicqyCag7FCsN800sUCXjWB0_DN8oXXIb50pKLIHbIgRvCgHGyBm7IavPbozPz10VGrSDn8-0Hqe8DLV-F_8aiFG9x8c2S3m__RsPWhqAEuQSk2liUEb9Y-H_hdOF1Z12Jo6K8CpbZUbZNUAraXWkdl_8OqIA34EV2T5B0pQ6Mnl2OwwpUVd4RSygGmBwA6HFe11B6kUmLfBTqXYugcm9WuFDJUEO67DdvuV3hpbb0BSaWE_3dJEB2xyMOvF9vVlu2jXUU85kclU_AGgNhZc";

        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        return $this->render('auth/index.html.twig', [
            'controller_name' => $jwtPayload->username,
        ]);
    }

}
