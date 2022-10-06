<template>
    <section id="main" class="container">
        <main class="mt-5">
            <AppLoader v-if="isLoading" />
            <div v-else>
                <div v-if="posts.length">
                    <h1>Posts</h1>
                    <div>
                        <PostCard
                            v-for="post in posts"
                            :key="post.id"
                            :post="post"
                        />
                    </div>
                </div>
                <div v-else>
                    <h1>Nessun post disponibile</h1>
                </div>
            </div>
        </main>
    </section>
</template>

<script>
import Axios from "axios";
import PostCard from "./PostCard.vue";
import AppLoader from "./AppLoader.vue";
export default {
    name: "AppMain",
    components: { PostCard, AppLoader },
    data() {
        return {
            posts: [],
            isLoading: false,
        };
    },
    methods: {
        fetchPosts() {
            this.isLoading = true;
            Axios.get("http://127.0.0.1:8000/api/posts")
                .then((res) => {
                    this.posts = res.data.posts;
                })
                .catch((err) => {
                    console.log("Errore nel fetch dei dati!");
                })
                .then(() => {
                    console.log("Tutto appost");
                    this.isLoading = false;
                });
        },
    },
    mounted() {
        this.fetchPosts();
    },
};
</script>

<style lang="scss" scoped></style>
