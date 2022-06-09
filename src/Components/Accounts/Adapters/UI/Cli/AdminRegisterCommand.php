<?php

namespace Components\Accounts\Adapters\UI\Cli;

use Components\Accounts\Application\Account;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class AdminRegisterCommand extends Command
{
    /** @var string */
    protected $signature = 'app:admin-register {firstName} {lastName} {email}';

    /** @var string */
    protected $description = 'Registers admin user
                              {firstName : Admin first name}
                              {lastName : Admin last name}
                              {email: Admin email address}';

    public function handle(Account $account): void
    {
        [$firstName, $lastName, $email] = [
            $this->input->getArgument('firstName'),
            $this->input->getArgument('lastName'),
            $this->input->getArgument('email'),
        ];

        try {
            $account->createAdmin($firstName, $lastName, $email, $password = Str::random());

            $this->info(sprintf('Admin %s registered. Password: %s', $email, $password));
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
