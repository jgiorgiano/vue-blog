import Home from "./views/Home"
import Login from "./views/Loggin"
import Register from "./views/Register"
import About from "./views/About"

const routes = [
    { path: '/', name:'home', component: Home },
    { path: '/login', name:'login', component: Login },
    { path: '/about', name:'about', component: About }
]

export default routes;
