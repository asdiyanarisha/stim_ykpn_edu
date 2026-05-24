<?php

namespace Tests\Feature;

use App\Mail\PmbRegistrationMail;
use App\Models\Pmb;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PmbEmailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that successful PMB registration sends email.
     */
    public function test_pmb_registration_sends_email_successfully(): void
    {
        Mail::fake();

        $data = [
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budisantoso@example.com',
            'nomor_hp_wa' => '081234567890',
            'tempat_lahir' => 'Sleman',
            'tanggal_lahir' => '2004-05-12',
            'jenis_kelamin' => 'Laki-laki',
            'alamat_asal' => 'Jl. Kaliurang KM 10',
            'asal_sekolah' => 'SMA N 1 Sleman',
            'program_studi' => 'Manajemen',
            'sumber_informasi' => 'Website',
            'jalur_registrasi' => 'Reguler',
            'kode_voucher' => null,
        ];

        $response = $this->postJson('/api/pmb/register', $data);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Pendaftaran Mahasiswa Baru berhasil disubmit.',
        ]);

        // Assert database has the record
        $this->assertDatabaseHas('pmb', [
            'email' => 'budisantoso@example.com',
        ]);

        // Assert that the mail was sent to the candidate
        Mail::assertSent(PmbRegistrationMail::class, function ($mail) use ($data) {
            return $mail->hasTo('budisantoso@example.com') &&
                   $mail->pmb->nama_lengkap === $data['nama_lengkap'] &&
                   $mail->pmb->program_studi === $data['program_studi'];
        });
    }
}
