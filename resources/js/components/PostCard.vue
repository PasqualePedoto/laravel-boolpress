<template>
    <div class="mb-4 d-flex flex-row post-card">
        <figure class="m-0 h-100">
            <img
                :src="post.image"
                class="card-img-top img-fluid"
                :alt="post.image"
            />
        </figure>
        <div class="flex-grow-1">
            <div
                class="card-header d-flex align-items-center justify-content-between"
            >
                <p class="d-flex align-items-center m-0">{{ post.title }}</p>
                <div>
                    <router-link
                        class="btn btn-primary"
                        :to="{
                            name: 'post-detail',
                            params: { slug: post.slug },
                        }"
                        ><i class="fa-solid fa-eye"></i
                    ></router-link>
                </div>
            </div>
            <p class="card-text">{{ post.content }}</p>
            <div
                class="card-footer d-flex align-items-center justify-content-between"
            >
                <p class="d-flex align-items-center m-0">
                    {{ post.author.name }}
                </p>
                <div>
                    <button class="btn btn-secondary" @click="$router.back()">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCard",
    props: {
        post: Object,
    },
};
</script>

<style lang="scss" scoped>
.post-card {
    width: 100%;
    height: 300px;

    figure {
        width: 40%;
    }
}
</style>
