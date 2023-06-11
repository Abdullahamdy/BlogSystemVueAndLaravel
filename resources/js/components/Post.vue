<template>
  <div class="row">
    <div class="col-md-8" v-if="issearching">searching....</div>
    <div class="col-md-8" v-else>
      <div class="media simple-post" v-for="post in posts.data" :key="post.id">
        <img
          class="mr-3"
          :src="'/img/' + post.image"
          alt="Generic placeholder image"
        />
        <div class="media-body">
          <h4 class="mt-0">
            <router-link :to="'/post/' + post.slug">
              {{ post.title }}
            </router-link>
          </h4>
          {{ post.body.substr(0, 150) }}
          <ul class="list-inline list-unstyled d-flex post-info">
            <li>
              <span
                ><i class="fa fa-user"></i> posted by :
                <strong class="text-primary">{{ post.user.name }}</strong>
              </span>
            </li>
            <li>|</li>
            <li>
              <span><i class="fa fa-calendar"></i> {{ post.created_at }} </span>
            </li>
            <li>|</li>
            <span
              ><i class="fa fa-comment"></i>
              {{ post.comments_count }} comments</span
            >
          </ul>
        </div>
      </div>
      <pagination
        :data="posts"
        @pagination-change-page="getPosts"
      ></pagination>
    </div>
    <div class="col-md-4">
      <!-- Search Widget -->
      <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              placeholder="Search for..."
              v-model="searchPost"
            />
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>

      <!-- Categories Widget -->
      <Categories></Categories>
    </div>
  </div>
</template>

<script>
import Categories from "./Categories.vue";

export default {
  name: "Post",
  data() {
    return {
      posts: {},
      singlepost: {},
      searchPost: "",
      issearching: false,
    };
  },

  components: {
    Categories,
  },
  watch: {
    searchPost(query) {
      if (query.length > 0) {
        axios
          .get("/api/getpost/" + query)
          .then((res) => {
            (this.issearching = false), (this.posts = res.data);
            this.issearching = false;
          })
          .catch((err) => {});
      } else {
        let oldposts = JSON.parse(localStorage.getItem("posts"));
        this.posts = oldposts;
      }
    },
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    getPosts(page = 1) {
      axios
        .get("/api/posts?page="+page)
        .then((res) => {
          this.posts = res.data;
          localStorage.setItem("posts", JSON.stringify(this.posts));
        })
        .then((err) => console.log(err));
    },

  },
};
</script>
<style scoped>
</style>
