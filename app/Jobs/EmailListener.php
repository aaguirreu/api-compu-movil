<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Webklex\IMAP\Facades\Client;
use App\Models\UserImapCredential;
use App\Models\Transaccion;

class EmailListener implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $credential;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserImapCredential $credential)
    {
        $this->credential = $credential;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Configurar el cliente IMAP con las credenciales del usuario
        $client = Client::make([
            'host'  => $this->credential->imap_host,
            'port'  => $this->credential->imap_port,
            'encryption'    => $this->credential->imap_encryption,
            'validate_cert' => true,
            'username' => $this->credential->imap_username,
            'password' => $this->credential->imap_password,
        ]);

        $client->connect();

        // Obtener todos los mensajes en la bandeja de entrada
        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->all()->get();

        // Procesar cada mensaje
        foreach ($messages as $message) {
            $data = $this->extractTransactionData($message);

            if ($data) {
                Transaccion::create($data);
            }

            // Marcar el mensaje como leído
            $message->setFlag('seen');
        }

        $client->disconnect();
    }

    /**
     * Extraer datos de transacción del mensaje de correo electrónico.
     *
     * @param \Webklex\IMAP\Support\Message $message
     * @return array|null
     */
    protected function extractTransactionData($message)
    {
        // Aquí puedes extraer los datos necesarios del correo electrónico
        if (preg_match('/Transaction: (\d+), Amount: (\d+), Description: (.+)/', $message->getSubject(), $matches)) {
            return [
                'banco_id' => 1, // Ajustar según sea necesario
                'tipo' => $matches[1],
                'monto' => $matches[2],
                'descripcion' => $matches[3],
                'created_at' => now(),
            ];
        }

        return null;
    }
}
