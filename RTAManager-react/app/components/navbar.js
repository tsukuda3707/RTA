import React from 'react';
import {Link} from 'react-router';

const Navbar = () => (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <Link className="navbar-brand" to="#">RTA Manager</Link>
        <button className="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="navbarResponsive">
            <ul className="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li className="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <Link className="nav-link" to="/ptl">
                        <i className="fa fa-fw fa-table"></i>
                        <span className="nav-link-text">
                PTL</span>
                    </Link>
                </li>
                <li className="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <Link className="nav-link" to="/dashboard">
                        <i className="fa fa-fw fa-table"></i>
                        <span className="nav-link-text">
                Dashboard</span>
                    </Link>
                </li>
                <li className="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <Link className="nav-link" to="/about">
                        <i className="fa fa-fw fa-table"></i>
                        <span className="nav-link-text">
                About</span>
                    </Link>
                </li>
            </ul>
        </div>
    </nav>
);
export default Navbar;
