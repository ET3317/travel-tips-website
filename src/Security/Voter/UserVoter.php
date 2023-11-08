<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    public const USER_EDIT = 'user_edit';
    public const USER_DELETE = 'user_delete';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // Remplacez avec votre propre logique
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::USER_EDIT, self::USER_DELETE])
            && $subject instanceof UserInterface;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // si l'utilisateur est anonyme, n'accordez pas l'accès
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (vérifier les conditions et renvoyer vrai pour accorder la permission) ...
        return match ($attribute) {
            self::USER_EDIT => $this->canEditUser($subject, $user),
            self::USER_DELETE => $this->canDeleteUser($subject, $user),
            default => false,
        };
    }

    private function canEditUser(UserInterface $user, UserInterface $currentUser): bool
    {
        // Vérifiez si l'utilisateur actuel est identique à l'utilisateur en cours d'édition.
        return $user === $currentUser;
    }

    private function canDeleteUser(UserInterface $user, UserInterface $currentUser): bool
    {
        // Vérifiez si l'utilisateur actuel est identique à l'utilisateur en cours d'édition.
        return $user === $currentUser;
    }
}
