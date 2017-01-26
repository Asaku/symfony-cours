<?php
namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\User;

/**
 * Created by PhpStorm.
 * User: formateur
 * Date: 25/01/2017
 * Time: 15:51
 */
class EncoderUser
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->encode($entity);
    }

    /**
     * @param $entity
     */
    public function encode($entity)
    {
        if (!$entity instanceof User)
            return;

        $entity->setUsername($this->encodeData($entity->getUsername()));
    }

    /**
     * @param $string
     * @return string
     */
    private function encodeData($string)
    {
        $res = openssl_encrypt($string, 'AES-256-CBC', 'dsdsdsdd', OPENSSL_RAW_DATA, 'vectore');

        return base64_encode($res);
    }
}