import Home from "@/views/Home"
import Login from "@/views/Login"
import Register from "@/views/Register"
import About from "@/views/About"
import Dashboard from "@/views/Dashboard"
import EmailVerification from "@/views/EmailVerification";
import MyAccount from "@/views/MyAccount";
import ArticleCreate from "@/views/article/create";
import ArticleEdit from "@/views/article/edit";
import ArticleShow from "@/views/article/show";
import Search from "@/views/Search";
import Resume from "@/views/Resume";
import middleware from "@/services/middleware";

const routes = [
    //Open Routes
    { path: '/login', name:'login', component: Login, beforeEnter: middleware.redirectIfAuthenticated },
    { path: '/register', name:'register', component: Register, beforeEnter: middleware.redirectIfAuthenticated },
    { path: '/', name:'home', component: Home },
    { path: '/search', name:'search', component: Search },
    { path: '/about', name:'about', component: About },
    { path: '/email-verification', name:'email-verification', component: EmailVerification, beforeEnter: middleware.redirectIfNotUserSet },
    { path: '/resume', name:'resume', component: Resume },
    { path: '/article/:id', name:'article-show', component: ArticleShow },

    //Auth Routes
    { path: '/dashboard', name:'dashboard', component: Dashboard , beforeEnter: middleware.redirectIfNotAuthenticated },
    { path: '/my-account', name:'my-account', component: MyAccount , beforeEnter: middleware.redirectIfNotAuthenticated },
    { path: '/article', name:'article-create', component: ArticleCreate , beforeEnter: middleware.redirectIfNotAuthenticated },
    { path: '/article/:id/edit', name:'article-edit', component: ArticleEdit , beforeEnter: middleware.redirectIfNotAuthenticated },
]

export default routes;
