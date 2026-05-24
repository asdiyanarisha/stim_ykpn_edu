<?php

namespace App\Jobs;

use App\Models\Pmb;
use App\Mail\PmbRegistrationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendPmbRegistrationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pmb;

    /**
     * Create a new job instance.
     *
     * @param Pmb $pmb
     */
    public function __construct(Pmb $pmb)
    {
        $this->pmb = $pmb;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Send the email synchronously inside this queued job
            Mail::to($this->pmb->email)->send(new PmbRegistrationMail($this->pmb));
            
            // If email is successfully sent, update status to "Registrasi Awal" (ID 1)
            $this->pmb->update([
                'pmb_status_id' => 1
            ]);
            
            Log::info('Email PMB berhasil dikirim ke ' . $this->pmb->email . ' dan status diupdate ke Registrasi Awal untuk ID: ' . $this->pmb->id_pendaftar);
        } catch (\Exception $e) {
            Log::error('Job Gagal mengirim email PMB ke ' . $this->pmb->email . ' untuk ID ' . $this->pmb->id_pendaftar . ': ' . $e->getMessage());
            
            // Update status to "Gagal Mengirim Email" (ID 8)
            $this->pmb->update([
                'pmb_status_id' => 8
            ]);
            
            // We rethrow the exception so the job is marked as failed and can be retried
            throw $e;
        }
    }
}
