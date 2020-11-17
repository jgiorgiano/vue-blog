import Home from "./views/Home"
import Login from "./views/Login"
import Register from "./views/Register"
import About from "./views/About"
import Dashboard from "./views/Dashboard"
import EmailVerification from "./views/EmailVerification";
import MyAccount from "./views/MyAccount";
import ArticleCreate from "./views/article/create";
import ArticleEdit from "./views/article/edit";

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
    { path: '/article-create', name:'article-create', component: ArticleCreate },
    { path: '/article-edit', name:'article-edit', component: ArticleEdit },
]

export default routes;
