// import React from "react";

import { Outlet } from "react-router-dom";
import NavBar from "../common/nav-bar";
import Footer from "../common/Footer";
import PagesStyling from "../styling/pages-styling";

const MainLayout = () => {
    return (
        <div>
            <PagesStyling>
                <NavBar />
                <Outlet />
            </PagesStyling>
            <Footer />
        </div>
    );
};

export default MainLayout;
