<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    public const USER_EDIT = 'user_edit';
    public const USER_DELETE = 'user_delete';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::USER_EDIT, self::USER_DELETE])
            && $subject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        return match ($attribute) {
            self::USER_EDIT => $this->canEditUser($subject, $user),
            self::USER_DELETE => $this->canDeleteUser($subject, $user),
            default => false,
        };
    }

    private function canEditUser(User $user, User $currentUser): bool
    {
        // Check if the current user is the same as the user being edited.
        return $user === $currentUser;
    }

    private function canDeleteUser(User $user, User $currentUser): bool
    {
        // Check if the current user is the same as the user being edited.
        return $user === $currentUser;
    }

}
