<?php namespace LMK\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use LMK\FitnessData;
use LMK\Participant;

class ParticipantController extends Controller {

	public function index()
	{
        $participants = Participant::all();

		return view('participants')->with(array(
            'participants'  => $participants,
        ));
	}

    public function reload($id, $timespan = 'yesterday')
    {
        $endDate = null;
        if ($timespan == 'week') {
            $date = strtotime('-8 day');
            $message = 'Getting data for a week ending yesterday for ';
        } elseif ($timespan == 'today') {
            $date = strtotime('today');
            $endDate = $date;
            $message = 'Getting data for today for ';
        } elseif ($timespan == 'yesterday') {
            $date = strtotime('-1 day');
            $message = 'Getting data for yesterday for ';
        }

        $participant = Participant::findOrFail($id);
        $participant->updateFitnessData($date, $endDate);

        $message .= $participant->name;

        return redirect('/participants')->with('message', $message);
    }
}