<template>
    <div class="container">
        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
                <!-- Title -->
                <h1 class="mt-4">{{ PostDetails.title }}</h1>

                <!-- Author -->
                <p class="alert alert-info" style="width: fit-content; padding: 5px; color: #142d31"
                    v-if="PostDetails.category">
                    {{ PostDetails.category.name }}
                </p>

                <hr />

                <!-- Date/Time -->
                <p>
                    Posted on
                    <strong class="badge badge-primary p-1">{{
                        PostDetails.added_at
                    }}</strong>
                    <span class="float-right"><strong class="badge badge-info p-1">{{
                        comments.length
                    }}</strong>
                        comments</span>
                </p>

                <hr />

                <!-- Preview Image -->
                <img class="img-fluid rounded" :src="'/img/' + PostDetails.image" style="width: 900px; max-height: 300px"
                    alt="" />

                <hr />

                <!-- Post Content -->
                {{ PostDetails.body }}
                <hr />

                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <input type="hidden" v-model="post_id">
                                <textarea class="form-control" rows="3" v-model="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" @click.prevent="addcomment">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Single Comment -->
                <div class="media mb-4" v-for="comment in PostDetails.comments" :key="comment.id">
                    <img class="d-flex mr-3 rounded-circle" :src="'/img/' + comment.user.profile_img" width="50px" alt="" />
                    <div class="media-body">
                        <h5 class="mt-0">{{ comment.user.name }}</h5>
                        {{ comment.body }}
                    </div>
                </div>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." />
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">Freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</template>

<script>
export default {
    name: "PostDetails",
    data() {
        return {
            PostDetails: {},
            body: '',
            post_id: '',
            comments: [],
        };
    },
    created() {
        this.getpost();
        this.updateToken()
    },
    methods: {
        getpost() {
            axios
                .get("/api/posts/" + this.$route.params.slug)
                .then((res) => {
                    this.PostDetails = res.data;
                    this.post_id = this.PostDetails.id;
                    this.comments = this.PostDetails.comments;
                    this.initializelistener();
                });
        },
        initializelistener() {
            Echo.private(`newComment.${this.post_id}`)
                .listen('NewComment', (e) => {
                    this.comments.unshift(e.comment)
                    console.log(e);
                });
        },
        addcomment() {
            let { body, post_id } = this;
            axios.post('/api/comment/create', { body, post_id })
                .then(res => {
                    this.comments.unshift(res.data)
                    this.body = '',
                        console.log(res.data)
                })
        },
        updateToken() {
            let token = JSON.parse(localStorage.getItem('userToken'));
            this.$store.commit('setUserToken', token)
        }
    },
    computed: {
        isLogged() {
            return this.$store.getters.isLogged;
        }
    }

};
</script>
<style scoped></style>
