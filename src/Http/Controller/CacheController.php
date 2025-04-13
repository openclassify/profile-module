<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Visiosoft\AddblockExtension\Command\addBlock;

class CacheController extends PublicController
{
    public function getUserInfo()
    {
        $user = auth()->user();
        $profile_img =  $user ? $this->dispatchSync(
            new MakeImageInstance($user->file ?: 'visiosoft.theme.sahibinden::images/no_profile.svg', 'img')
        )->url() : $user;
        $user = $user ? $user->name() : $user;

        return ['userName' => $user, 'profileImg' => $profile_img];
    }
}
