import Home from "./views/Home"
import Login from "./views/Login"
import Register from "./views/Register"
import About from "./views/About"

const routes = [
    { path: '/', name:'home', component: Home },
    { path: '/login', name:'login', component: Login },
    { path: '/register', name:'register', component: Register },
    { path: '/about', name:'about', component: About }
]

export default routes;
