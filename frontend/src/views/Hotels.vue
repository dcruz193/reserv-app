<template>
  <div>
    <div class="container">
      <div class="search">
        <input type="search" required v-model="email" placeholder="Input you mail here to search your reservations">
        <button type="button" @click="searchReservations()" class="cursor" >Search</button>
      </div>
    <div class="card cursor" @click="seeRooms(hotel.id)" v-for="(hotel, index) in hotels" :key="index">
        <h2 class="title text-muted">{{ hotel.name }}</h2>
        <div class="rooms hidden" :class="'rooms-'+hotel.id">
          <p class="text-muted">Rooms</p>
          <hr>
          <table class="table">
            <thead>
              <tr>
                <th>Type</th>
                <th>Available</th>
              </tr>
            </thead>
            <tbody>
              <tr :class="'room-'+room.id" @click="reserve(hotel.id,room)" v-for="(room, index) in hotel.rooms" :key="index">
                <td>{{ room.type }}</td>
                <td>{{ room.available }}</td>
              </tr>
            </tbody>
          </table>
          <div class="reserve hidden" :class="'reserve-'+hotel.id">
            <input type="text" v-model="user.name" placeholder="Please input your name">
            <input type="email" v-model="user.email" placeholder="Please input your email">
            <div class="btn-reserv">
              <button class="cursor" @click="doReservation()" >Reserve</button>

            </div>

          </div>

        </div>
    </div>

    </div>
  </div>

</template>
<script>

import axios from 'axios';
import $ from 'jquery';

export default {
  data(){
    return{
      hotels: [],
      email:'',
      user: {
        name: '',
        email: ''
      },
      reservation: {
        hotel_id: '',
        room_type: ''
      }
    }
  },
  created: function(){
    this.getHotels();
  },
  methods: {
    searchReservations: function(){
      this.$router.push('/reservations/email/'+this.email);
    },
    doReservation: function(){

      let user = this.user;
      let reservation = this.reservation;

      let data = {
              user,
              reservation
      };
      
      axios.post('http://127.0.0.1:8000/api/v1/reservations', { data: JSON.stringify(data) }).then( res => {
        console.log(res);
        this.$router.push('/reservations/email/'+this.user.email);
        this.user.name = '';
        this.user.email = '';
      });
    },
    reserve: function( hotel_id,room ){
      
      $('.room-'+room.id).addClass('selected');
      $('.reserve-'+hotel_id).removeClass('hidden').addClass('show');

      this.reservation.hotel_id = hotel_id;
      this.reservation.room_type = room.type;

    },
    seeRooms: function( hotel_id ){

      $('.rooms-'+hotel_id).removeClass('hidden').addClass('show');
    
    },
    getHotels: function(){
      axios.get('http://127.0.0.1:8000/api/v1/hotels').then( res => {
        console.log(res);
        this.hotels = res.data.data;
      });
    }
  }
}
</script>