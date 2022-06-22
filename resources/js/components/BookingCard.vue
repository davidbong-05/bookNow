<template>
    <div class="card mb-2">
        <div class="card-header">
            <span class="h6">Booking ID: {{ booking.id }}</span>
            <del-booking-button v-show="booking.status === 'Approved' || booking.status === 'Pending'"
                :booking-id="booking.id" />
        </div>
        <div class="card-body">
            <ul>
                <li>
                    Facility: {{ facility }}
                </li>
                <li>
                    Court: {{ court }}
                </li>
                <li>
                    Date: {{ booking.date }}
                </li>
                <li>
                    Time: {{ booking.time }}
                </li>
                <li>
                    Status: <span :class="booking.status">{{ booking.status }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    props: [
        'booking',
        'facility',
        'court'
    ]
}
</script>
<style scoped>
.Canceled,.Rejected {color: #dc3545;}
.Pending {color: #ffc107;}
.Approved {color: #28a745;}
.Completed{color: #0275d8;}
</style>
