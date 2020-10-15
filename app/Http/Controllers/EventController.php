<?php

namespace App\Http\Controllers;

use App\Event;
use App\Speakar;
use App\Sponsor;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEvents(){
        return Event::orderBy('id', 'desc')->get();
    }

    public function singleEvents(Request $request, $params){
        return Event::where('id', $params)->orderBy('id', 'desc')->first();
    }

    public function addEventDetails(Request $request){
        // validate request
    	$this->validate($request, [
    		'title' => 'required',
    		'description' => 'required',
    		'time' => 'required',
    		'loction' => 'required',
    		'locationName' => 'required',
    		'about' => 'required',
    		'image' => 'required'
        ]);
        
        // $id = $request->id;
        
    	return Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'time' => $request->time,
            'loction' => $request->loction,
            'locationName' => $request->locationName,
            'about' => $request->about,
            'image' => $request->image,
        ]);
    }

    public function addEventSpeaker(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'profession' => 'required',
    		'image' => 'required'
        ]);
        
        // $id = $request->id;
        
    	return Speakar::create([
            'name' => $request->name,
            'profession' => $request->profession,
            'image' => $request->image,
            'event_id' => $request->event_id
        ]);
    }

    public function addEventSponsor(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'image' => 'required'
        ]);
        
        // $id = $request->id;
        
    	return Sponsor::create([
            'name' => $request->name,
            'image' => $request->image,
            'event_id' => $request->event_id
        ]);
    }

    public function getEventsSpeakers(Request $request, $params){
        return Speakar::where('event_id', $params)->orderBy('id', 'desc')->get();
    }

    public function getEventsSponsors(Request $request, $params){
        return Sponsor::where('event_id', $params)->orderBy('id', 'desc')->get();
    }

    // Edit sponsors
    public function editEventSponsor(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'image' => 'required'
        ]);
        
        $id = $request->id;

        $editSponsor = Sponsor::where('id', $request->id)->update([
    		'id' => $request->id,
            'name' => $request->name,
            'image' => $request->image
        ]);

        return Sponsor::where('id', $request->id)->first();
    }

    public function addNewEventSponsor(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'image' => 'required'
        ]);
        
        // $id = $request->id;
        
    	return Sponsor::create([
            'name' => $request->name,
            'image' => $request->image,
            'event_id' => $request->event_id
        ]);
    }

    public function deleteSponsor(Request $request){
        $this->validate($request, [
    		'id' => 'required'
    	]);
        
        // return $request->id;
    	return Sponsor::where('id', $request->id)->delete();
    }

    public function addNewEventSpeaker(Request $request){
        $this->validate($request, [
    		'name' => 'required',
    		'profession' => 'required',
    		'image' => 'required'
        ]);
        
        // $id = $request->id;
        
    	return Speakar::create([
            'name' => $request->name,
            'profession' => $request->profession,
            'image' => $request->image,
            'event_id' => $request->event_id
        ]);
    }

    public function editEventSpeaker(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'profession' => 'required',
    		'image' => 'required'
        ]);
        
        $id = $request->id;

        $editSpeaker = Speakar::where('id', $request->id)->update([
            'id' => $request->id,
    		'name' => $request->name,
            'profession' => $request->profession,
            'image' => $request->image,
        ]);

        return Speakar::where('id', $request->id)->first();
    }
}
