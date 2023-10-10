<template>
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-bell"></i>
            <span class="badge badge-danger">{{ notifications.length }}</span>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <div class="media p-2" v-for="(n, i) in notifications" :key="i">
                <img class="mr-2" style="height: 60px;width: 60px;"
                    src="https://www.kindpng.com/picc/m/495-4952535_create-digital-profile-icon-blue-user-profile-icon.png"
                    alt="commenter image">
                <div class="media-body">
                    <div class="mt-0"><strong>{{ n.data.comment_owner.name }}</strong> added a comment on your post
                        <div class="container">
                            <div class="content">
                                <!-- Your other content here -->
                                <i class="fa fa-check" :class="n.read_at  ? 'text-success' : 'text-danger'"
                                    @click="makeNotificationsRead(n, $event)"></i>
                            </div>
                        </div>

                    </div>
                    <router-link class="p-0" :to="`/post${n.data.post.slug}`" target="_blank">{{ n.data.post.title
                    }}</router-link>
                    <p class="m-0"><i class="fa fa-clock-o mr-1"></i> {{ n.data.commented_at }} </p>

                </div>
            </div>
            <div>
                <router-link :to="'/Notifications'" class="see-all"><i class="fa fa-bell-o mr-2"></i>See All </router-link>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getUnreadNotifications();

    },
    computed: {
        notifications() {
            return this.$store.state.notification;

        }
    },
    methods: {
        getUnreadNotifications() {
            axios.get('/api/getUnreadNotifications')
                .then(res => {
                    this.$store.state.notification = res.data

                }).catch(err => {
                    console.log(err)
                })

        },
        makeNotificationsRead(notification, event) {
            axios.put('/api/makeNotificationsRead', { 'id': notification.id }).then(res => {
                console.log(res);
                if(res.data.msg = 'OK'){
                    event.target.classList.remove('text-danger');
                    event.target.classList.add('text-success');

                }
            }).catch(err => {
                console.log(err);

            })
        }

    },


}
</script>
<style scoped>
.dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover,
.dropdown:hover .dropbtn {
    background-color: #686e73;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    min-width: 287px;
    max-height: 400px;
    overflow: auto;
}

.dropdown-content .media-body>div {
    font-size: 15px;
    line-height: 1.3;
}

.dropdown-content .media-body a {
    float: none;
    color: #1580dc;
    background: none;
    text-decoration: none;
    display: block;
    text-align: left;
}

.see-all {
    color: #000;
    background: #e4dede;
    text-decoration: none;
    text-align: center !important;
    display: block;
    padding: 4px;
}

.dropdown-content p {
    font-size: 14px;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.container {
    position: relative;
    /* Ensure the container is relatively positioned */
}

.content {
    padding-right: 20px;
    /* Add some padding to the right to prevent the icon from sticking to the edge */
}

.icon {
    position: absolute;
    top: 50%;
    /* Vertically center the icon */
    right: 0;
    /* Move the icon to the maximum right */
    transform: translate(-50%, -50%);
    /* Adjust the position to center the icon perfectly */
}
</style>
