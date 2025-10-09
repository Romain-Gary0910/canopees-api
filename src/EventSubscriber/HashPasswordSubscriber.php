<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HashPasswordSubscriber implements EventSubscriber
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function getSubscribedEvents(): array
    {
        // Pour écouter les événements Doctrine avant l’insertion et la mise à jour
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    // Méthode appelée avant la sauvegarde ou la mise à jour d’un User
    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->encodePassword($args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->encodePassword($args);
    }

    private function encodePassword(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // Pour agir uniquement sur l’entité User
        if (!$entity instanceof User) {
            return;
        }

        // Si un mot de passe en clair est défini, on le hash
        $plainPassword = $entity->getPlainPassword();
        if ($plainPassword) {
            $hashed = $this->passwordHasher->hashPassword($entity, $plainPassword);
            $entity->setPassword($hashed);
            $entity->eraseCredentials(); // On efface le mot de passe en clair
        }
    }
}