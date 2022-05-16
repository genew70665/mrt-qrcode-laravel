<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendScannedData extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $accountID, $email, $company, $address1, $address2, $city, $zip, $notes, $data)
    {
        $this->accountID = $accountID;
        $this->name = $name;

        $this->email = $email;
        $this->company = $company;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->zip = $zip;
        $this->notes = $notes;

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Scanned Equipment Data')->markdown('emails/scanned_data')->with([
            'data'=>$this->data,
            'name' => $this->name,
            'accountID' => $this->accountID,
            'email' => $this->email,
            'company' => $this->company,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'zip' => $this->zip,
            'notes' => $this->notes,
        ]);
    }
}
