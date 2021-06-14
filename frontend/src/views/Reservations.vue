<template>
    <div class="container">
        <h2>Your reservations</h2>
        <table class="tbl-reservations">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Hotel</th>
                    <th>Room Type</th>
                    <th>Reservation date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(reserve, i) in reservations" :key="i">
                    <td> {{ i + 1 }} </td>
                    <td> {{ reserve.hotel_name }} </td>
                    <td> {{ reserve.room_type }} </td>
                    <td> {{ reserve.created_at }} </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

import axios from 'axios';


export default {
    data() {
        return{
            reservations: []
        }
    },
    created: function(){
        this.getReservations();
    },
    methods: {
        
        getReservations: function ( ) {
            let email = this.$route.params.email;
            axios.get('http://127.0.0.1:8000/api/v1/getReservations/'+email).then( res => {
                this.reservations = res.data.data;
            });
        }
    }
}
</script>