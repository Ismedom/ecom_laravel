/*
setting up route for all of page in app


*/
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import RegisterLayout from "./components/layouts/Register-layout";
import NotFound from "./pages/notFound/NotFound";
import ProductLayout from "./components/layouts/product-layout";
import Home from "./pages/products/Home";
import Shoping from "./pages/products/Shoping";
import TermAndPolicy from "./pages/products/Term-and-policy";
import UserSavedLayout from "./components/layouts/user-saved-layout";
import Save from "./pages/userSaved/Save";
import Cart from "./pages/userSaved/Cart";
import Register from "./pages/auth/Register";
import AboutServices from "./pages/products/about-services";
import MainLayout from "./components/layouts/main-layout";

const App = () => {
    return (
        <Router>
            <Routes>
                <Route element={<MainLayout />}>
                    {/* This part of route for product */}
                    <Route element={<ProductLayout />}>
                        <Route path="/" element={<Home />} />
                        <Route path="/shopping" element={<Shoping />} />
                        <Route
                            path="/term_policy"
                            element={<TermAndPolicy />}
                        />
                        <Route
                            path="/about_services"
                            element={<AboutServices />}
                        />
                    </Route>
                    {/* this part of route is for User saving */}
                    <Route element={<UserSavedLayout />}>
                        <Route path="/saved" element={<Save />} />
                        <Route path="/cart" element={<Cart />} />
                    </Route>
                </Route>

                {/* the Registation part  */}
                <Route element={<RegisterLayout />}>
                    <Route path="/register" element={<Register />} />
                    <Route path="/signin" element={<Register />} />
                </Route>

                {/* Not Found route */}
                <Route path="*" element={<NotFound />} />
            </Routes>
        </Router>
    );
};

export default App;
