<template>
    <section id="header">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Bollpress</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-4">
                            <router-link
                                class="text-secondary"
                                :to="{ name: 'posts' }"
                                >Posts</router-link
                            >
                        </li>
                        <li class="nav-item mr-4">
                            <router-link
                                class="text-secondary"
                                :to="{ name: 'about' }"
                                >About</router-link
                            >
                        </li>
                        <li class="nav-item mr-4">
                            <router-link
                                class="text-secondary"
                                :to="{ name: 'contacts' }"
                                >Contacts</router-link
                            >
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </section>
</template>

<script>
export default {
    name: "AppHeader",
};
</script>

<style lang="scss" scoped></style>
