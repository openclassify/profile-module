<?php namespace Visiosoft\ProfileModule\Profile\BasicRegister\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Notification\UserPendingActivation;
use Visiosoft\ProfileModule\Profile\BasicRegister\BasicRegisterFormBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Notifications\AnonymousNotifiable;

class HandleManualRegistration
{
    protected $builder;

    public function __construct(BasicRegisterFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function handle(MessageBag $messages, Repository $config)
    {
        if (!is_null($message = $this->builder->getFormOption('pending_message'))) {
            $messages->info($message);
        }

        /* @var UserInterface $user */
        $user = $this->builder->getFormEntry();

        $recipients = $config->get('anomaly.module.users::notifications.pending_user', []);

        foreach ($recipients as $email) {
            (new AnonymousNotifiable)
                ->route('mail', $email)
                ->notify(
                    new UserPendingActivation($user)
                );
        }
    }
}
