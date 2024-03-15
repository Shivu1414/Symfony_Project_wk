<?php

namespace App\Security;

use App\Entity\UserLogin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class EmptyAuthenticator extends AbstractGuardAuthenticator
{
    public function supports(Request $request): ?bool
    {
        return ($request->getPathInfo() === '/' && $request->isMethod('POST'));
    }
 

    public function getCredentials(Request $request):Response
    {
        // dd();
        // return $this->redirectToRoute('login');
        // dump($request->request->all());die;
    }
    

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // todo
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // todo
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // todo
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // todo
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
        // return $this->redirectToRoute('login');
        // dd($authException);
        // return $request->getPathInfo();
    }

    public function supportsRememberMe()
    {
        // todo
    }
}
