<template>
  <div class="container">
    <div class="row">
      <!-- Post Content Column -->
      <div class="col-lg-8">
        <!-- Title -->
        <h1 class="mt-4">{{ PostDetails.title }}</h1>

        <!-- Author -->
        <p
          class="alert alert-info"
          style="width: fit-content; padding: 5px; color: #142d31"
       v-if="PostDetails.category" >
          {{ PostDetails.category.name }}
        </p>

        <hr />

        <!-- Date/Time -->
        <p>
          Posted on
          <strong class="badge badge-primary p-1">{{
            PostDetails.added_at
          }}</strong>
          <span class="float-right"
            ><strong class="badge badge-info p-1">{{
              PostDetails.comments_count
            }}</strong>
            comments</span
          >
        </p>

        <hr />

        <!-- Preview Image -->
        <img
          class="img-fluid rounded"
          :src="'/img/' + PostDetails.image"
          style="width: 900px; max-height: 300px"
          alt=""
        />

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
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <div
          class="media mb-4"
          v-for="comment in PostDetails.comments"
          :key="comment.id"
        >
          <img
            class="d-flex mr-3 rounded-circle"
            :src="'/img/' + comment.user.profile_img"
            width="50px"
            alt=""
          />
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
              <input
                type="text"
                class="form-control"
                placeholder="Search for..."
              />
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
    };
  },
  created() {
    this.getpost();
  },
  methods: {
    getpost() {
      axios
        .get("/api/posts/" + this.$route.params.slug)
        .then((res) => {
          console.log(res.data);
          this.PostDetails = res.data;
        })
        .then((err) => {});
    },
  },
};
</script>
<style scoped>
</style>
