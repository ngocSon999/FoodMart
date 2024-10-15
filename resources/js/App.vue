<template>
    <div id="app">
        <header>
            <nav>
                <ul>
                    <li>
                        <router-link
                            :to="{name: 'Dashboard'}"
                        >
                            Dashboard
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            :to="{name: 'TradeMark'}"
                        >
                            TradeMark
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            :to="{name: 'Product'}"
                        >
                            Product
                        </router-link>
                    </li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/">Web</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <router-view />
        </main>

        <footer>
            <p>&copy; 2024 - My Laravel Vue App</p>
        </footer>
    </div>
</template>

<script>
import Trademark from "./trademark/Trademark.vue";

export default {
    name: "App",
    components: {Trademark},
};
</script>

<style scoped>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    text-align: center;
    color: #2c3e50;
}

header {
    background-color: #42b983;
    padding: 1rem;
}

nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 1rem;
}

footer {
    background-color: #35495e;
    color: white;
    padding: 1rem;
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    bottom: 0;
}
</style>
