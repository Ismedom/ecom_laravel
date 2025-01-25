// import React from 'react'

import { Outlet } from "react-router-dom";

const UserSavedLayout = () => {
    return (
        <div>
            {/* showing element from there */}

            <Outlet />
        </div>
    );
};

export default UserSavedLayout;
