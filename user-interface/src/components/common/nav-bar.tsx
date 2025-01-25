// import React from "react";

import { navBarItem } from "@/constants/nav-bar";
import { usersaved } from "@/constants/use-saved";
import { Link } from "react-router-dom";

const NavBar = () => {
    return (
        <nav className="flex justify-between items-center">
            <div>logo part</div>
            <div>
                <ul className="flex justify-center items-center gap-4">
                    {navBarItem.map(({ path, name }, index) => (
                        <li key={index}>
                            <Link to={path}>{name}</Link>
                        </li>
                    ))}
                </ul>
            </div>
            <div>
                <ul className="flex gap-2">
                    {usersaved.map(({ path, name }, index) => (
                        <li key={index}>
                            <Link to={path}>{name}</Link>
                        </li>
                    ))}
                </ul>
            </div>
        </nav>
    );
};

export default NavBar;
