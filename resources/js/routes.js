import Home from "./views/Home"
import Login from "./views/Login"
import Register from "./views/Register"
import About from "./views/About"
import Dashboard from "./views/Dashboard"
import EmailVerification from "./views/EmailVerification";
import MyAccount from "./views/MyAccount";

const routes = [
    //Open Routes
    { path: '/', name:'home', component: Home },
    { path: '/login', name:'login', component: Login },
    { path: '/register', name:'register', component: Register },
    { path: '/about', name:'about', component: About },
    { path: '/email-verification', name:'email-verification', component: EmailVerification },

    //Auth Routes
    { path: '/dashboard', name:'dashboard', component: Dashboard },
    { path: '/my-account', name:'my-account', component: MyAccount },
]

export default routes;
