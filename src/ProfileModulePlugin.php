<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\ProfileModule\Adress\Command\GetAddress;
use Visiosoft\ProfileModule\Adress\Command\GetAddressByUser;
use Visiosoft\ProfileModule\Profile\Command\GetProfileDetail;
use Visiosoft\ProfileModule\Profile\Command\GetProfilePhotoURL;
use Visiosoft\ProfileModule\Profile\Command\UserInitials;

class ProfileModulePlugin extends Plugin
{
    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction(
                'getAddress',
                function ($id) {

                    if (!$ad = $this->dispatchSync(new GetAddress($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig\TwigFunction(
                'getAddressByUser',
                function ($user_id) {

                    if (!$ad = $this->dispatchSync(new GetAddressByUser($user_id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig\TwigFunction(
                'getProfileDetail',
                function ($user_id) {

                    if (!$ad = $this->dispatchSync(new GetProfileDetail($user_id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig\TwigFunction(
                'profilePhoto',
                function ($user) {
                    return $this->dispatchSync(new GetProfilePhotoURL($user));
                }
            ),
            new \Twig\TwigFunction(
                'user_initials',
                function ($user) {
                    return $this->dispatchSync(new UserInitials($user));
                }
            ),
        ];
    }
}
