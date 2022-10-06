<template>
    <section class="post-detail container">
        <h1 class="my-3">{{ post.title }}</h1>
        <PostCard :post="post" />
    </section>
</template>

<script>
import PostCard from "../components/PostCard.vue";
export default {
    name: "PostDetailsPage",
    components: { PostCard },
    data() {
        return {
            post: null,
        };
    },
    methods: {
        fetchPost() {
            axios
                .get(
                    "http://127.0.0.1:8000/api/posts/" + this.$route.params.slug
                )
                .then((res) => {
                    this.post = res.data.post;
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    mounted() {
        this.fetchPost();
    },
};
</script>

<style></style>
