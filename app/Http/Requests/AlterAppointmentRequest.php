<?php

namespace App\Http\Requests;

use Timegridio\Concierge\Models\Appointment;
use Timegridio\Concierge\Models\Business;
use Auth;

class AlterAppointmentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $appointmentId = $this->get('appointment');
        $businessId = $this->get('business');

        $appointment = Appointment::find($appointmentId);

        $authorize = ($appointment->issuer->id == auth()->user()->id) || auth()->user()->isOwner($businessId);

        logger()->info("Authorize:$authorize");

        return $authorize;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
