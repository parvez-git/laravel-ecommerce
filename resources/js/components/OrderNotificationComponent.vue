<template>
    <li v-if="user.admin" class="nav-item dropdown">
        <a id="navbarDropdownNotification" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span>Notification</span>
            <span class="badge badge-pill badge-dark">{{ notifications.length }}</span>
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="navbarDropdownNotification">
            <span class="dropdown-item"
                v-for="notification in notifications"
                :key="notification.id" 
                @click="readNotification(notification)"
            >
                Order id: <strong>{{ notification.data['order_id'] }}</strong> &amp; Amount: <strong>${{ notification.data['amount'] }}</strong>
            </span>
            <span class="dropdown-item" v-if="notifications.length==0"> No Notification </span>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                notifications: []
            }
        },
        methods: {
            readNotification(notification){
                axios.get('admin/order/read/'+notification.id).then( response => {
                    location.reload(true);
                })
            }
        },
        created(){

            Echo.private(`App.User.${this.user.id}`).notification((notification) => {
                // this.notifications.push(notification)
                this.notifications.push({
                    id: notification.id,
                    type: notification.type,
                    data: {
                        order_id: notification.order_id,
                        amount: notification.amount
                    }
                })
            });
        },
        mounted() {

            axios.get('/admin/order/notification').then( response => {
                this.notifications = response.data
            });
        }
    }
</script>
