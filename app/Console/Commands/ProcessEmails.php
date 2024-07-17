<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Email;
use App\Jobs\EmailListener;
use Illuminate\Support\Facades\DB;

class ProcessEmails extends Command
{
    protected $signature = 'emails:process';

    protected $description = 'Process all emails from the database';

    public function handle()
    {
        $emails = Email::join('servidor_correo', 'emails.servidor_id', '=', 'servidor_correo.id')
            ->select('emails.*', 'servidor_correo.protocol', 'servidor_correo.host', 'servidor_correo.port', 'servidor_correo.encryption')
            ->get();

        foreach ($emails as $email) {
            dispatch(new EmailListener($email));
        }

        $this->info('All emails processed successfully.');
    }
}
