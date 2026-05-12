import './bootstrap';
import { createApp } from 'vue';
import router from './router'; // Import the file we just made
import App from './App.vue';   // We will create this next

const app = createApp(App);
app.use(router);
app.mount('#app');