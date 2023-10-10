<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3>Notification:{{ notifications.length }}</h3>
            </div>
            <div class="card-body">
                <div class="media p-2" v-for="(n, i) in notifications" :key="i">
                    <img class="mr-2" style="height: 60px;width: 60px;"
                        src="https://www.kindpng.com/picc/m/495-4952535_create-digital-profile-icon-blue-user-profile-icon.png"
                        alt="commenter image">
                    <div class="media-body">
                        <div class="mt-0"><strong>{{ n.data.comment_owner.name }}</strong> added a comment on your post
                            <i class="fa fa-check" :class="n.read_at  ? 'text-success' : 'text-danger'" @click="makeNotificationsRead(n,$event)"></i>
                        </div>
                        <router-link class="p-0" :to="`/post${n.data.post.slug}`" target="_blank">{{ n.data.post.title
                        }}</router-link>
                        <p class="m-0"><i class="fa fa-clock-o mr-1"></i> {{ n.data.commented_at }} </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            notifications: [],
        }

    },

    mounted() {
        this.getAllNotifications();

    },

    methods: {
        getAllNotifications() {
            axios.get('/api/getAllNotifications')
                .then(res => {
                    this.notifications = res.data;

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
<style scoped></style>
