<?php

namespace App\Http\Controllers\Api\V1;

use App\Hotel;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ReservationResource;
use App\Room;
use App\User;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->data, true);
        
        $validator = Validator::make($data['user'], [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ( $validator->validated() ) {

            $user = $data['user'];
            $reservation = $data['reservation'];
    
            $user_id = null;
    
            // Verify if exists registred user with your email
            $existsUser = User::where('email', $user['email'])->first();
            
            if ( $existsUser ) {
    
                $user_id = $existsUser->id;
    
                $saveResevation = $this->saveReservation($user_id, $reservation);
    
            }else{
                //Create user
                $saveUser = new User();
                $saveUser->name = $user['name'];     
                $saveUser->email = $user['email'];
                $saveUser->save();  
    
                $user_id = $saveUser->id;
    
                //Create reservation
                $saveResevation = $this->saveReservation($user_id, $reservation);
    
            }
    
            $reservations = Reservation::where('user_id', $user_id)->orderBy('created_at')->get();
    
            return ReservationResource::collection($reservations);

        }else{
            return $data;
        }


    }
    
    // Function to save reservations
    public function saveReservation( $user_id, $reservation ){

        $saveResevation = new Reservation();
        $saveResevation->user_id = $user_id;
        $saveResevation->hotel_id = $reservation['hotel_id'];
        $saveResevation->room_type = $reservation['room_type'];
        $saveResevation->save();

        // Discount available room
        $room = Room::where('hotel_id',$reservation['hotel_id'])->where('type', $reservation['room_type'])->first();
        
        if ( $room ) {
            $room->available = $room->available -1 ;
            $room->save();
        }
                                    

        return $saveResevation;
    }

    public function getReservations( $email ){
        
        $existsUser = User::where('email', $email)->first();

        if ( $existsUser) {
            
            $reservations = Reservation::where('user_id', $existsUser->id)->orderBy('created_at','desc')->get(); 
            
            return ReservationResource::collection($reservations);

        }else{
            return 'Email not exists';
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
